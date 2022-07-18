const fs = require('fs')
const path = require('path')
const logger = require("./logger")
const {v4: uuidv4} = require('uuid')
const mime = require('mime-types');
const {toDataURL, toString} = require('qrcode')
const qrcode = require('qrcode-terminal');
const {
    makeWALegacySocket,
    useMultiFileAuthState,
    useSingleFileLegacyAuthState,
    makeInMemoryStore,
    Browsers,
    DisconnectReason,
    delay,
    fetchLatestBaileysVersion,
} = require('@adiwajshing/baileys')
const makeWASocket = require('@adiwajshing/baileys').default

const useStore = !process.argv.includes('--no-store')
const doReplies = !process.argv.includes('--no-reply')

global.QRCode = '';

// external map to store retry counts of messages when decryption/encryption fails
// keep this out of the socket itself, so as to prevent a message decryption/encryption loop across socket restarts
const msgRetryCounterMap = {}

// the store maintains the data of the WA connection in memory
// can be written out to a file & read from it
const store = useStore ? makeInMemoryStore({logger}) : undefined
store?.readFromFile('./baileys_store_multi.json')
// save every 10s
setInterval(() => {
    store?.writeToFile('./baileys_store_multi.json')
}, 10_000)

const saveStore = () => {
    store?.writeToFile('./baileys_store_multi.json')
}

const deleteUnauthenticated = () => {
    fs.rmSync('./baileys_store_multi.json', { force: true, recursive: true})
    fs.rmdirSync('./baileys_auth_info', { force: true, recursive: true})
}

const sendMessageWTyping = async (sock, msg, jid) => {
    await sock.presenceSubscribe(jid)
    await delay(500)

    await sock.sendPresenceUpdate('composing', jid)
    await delay(2000)

    await sock.sendPresenceUpdate('paused', jid)

    await sock.sendMessage(jid, msg)
}

function getWhatsAppId(id = '') {
    if (id.includes('@g.us') || id.includes('@s.whatsapp.net')) return id
    return id.includes('-') ? `${id}@g.us` : `${id}@s.whatsapp.net`
}

function isGroup(id = '') {
    id = getWhatsAppId(id)
    return id.includes('@g.us')
}

// start a connection
const startSock = async () => {
    const {state, saveCreds} = await useMultiFileAuthState('baileys_auth_info')
    // fetch latest version of WA Web
    // const {version, isLatest} = await fetchLatestBaileysVersion()
    // logger.info(`using WA v${version.join('.')}, isLatest: ${isLatest}`)

    /**
     * @type {import('@adiwajshing/baileys').CommonSocketConfig}
     */
     const waConfig = {
        // version,
        logger,
        printQRInTerminal: true,
        auth: state,
        msgRetryCounterMap,
        // implement to handle retries
        getMessage: async key => {
            return {
                conversation: 'hello'
            }
        }
    }

    /**
     * @type {import('@adiwajshing/baileys').AnyWASocket}
     */
    const sock = makeWASocket(waConfig)

    global.Whatsapp = sock

    store?.bind(sock.ev)


    // Events
    sock.ev.on('connection.update', (update) => {
            // const update = events['connection.update']
            const {connection, lastDisconnect} = update
            logger.info('connection :')
            logger.info(connection)
            if (connection === 'close') {
                // reconnect if not logged out
                if (lastDisconnect?.error?.output?.statusCode !== DisconnectReason.loggedOut) {
                    startSock()
                } else {
                    logger.info('Connection closed. You are logged out.')
                    deleteUnauthenticated()
                }
            }

            // logger.info('connection update', update)
            
            if(update.qr) {
                // logger.info('Scan QR : ', qrcode. toString(update.qr))
                // logger.info('Scan QR toDataURL: ', toDataURL(update.qr))
                // global.QRCode = toString(update.qr)
                // qrcode.generate(update.qr, {small: true});
                global.QRCode = update.qr
                // qrcode.generate(update.qr, function (str) {
                //     // logger.info('Generated QR : ', str)
                //     // logger.info(str)
                //     global.QRCode = str
                // });
            }
            else {
                logger.info('connection update', update)
                global.QRCode = ''
            }
        }
    );
    // credentials updated -- save them
    sock.ev.on('creds.update', async () => {
            await saveCreds()
        }
    );
    sock.ev.on('call', (events) => {
            logger.info('recv call event', events)
        }
    );
    // chat history received
    sock.ev.on('chats.set', ({chats, isLatest}) => {
            // const {chats, isLatest} = events['chats.set']
            logger.info(`recv ${chats.length} chats (is latest: ${isLatest})`)
        }
    );
    // message history received
    sock.ev.on('messages.set', ({messages, isLatest}) => {
            // const {messages, isLatest} = events['messages.set']
            logger.info(`recv ${messages.length} messages (is latest: ${isLatest})`)
        }
    );
    sock.ev.on('contacts.set', ({contacts, isLatest}) => {
            // const {contacts, isLatest} = events['contacts.set']
            logger.info(`recv ${contacts.length} contacts (is latest: ${isLatest})`)
        }
    );
    // received a new message
    sock.ev.on('messages.upsert', async (upsert) => {
            // const upsert = events['messages.upsert']
            logger.info('recv messages ', JSON.stringify(upsert, undefined, 2))

            // if (upsert.type === 'notify') {
            //     for (const msg of upsert.messages) {
            //         if (!msg.key.fromMe && doReplies) {
            //             logger.info('replying to', msg.key.remoteJid)
            //             await sock.sendReadReceipt(msg.key.remoteJid, msg.key.participant, [msg.key.id])
            //             await sendMessageWTyping(sock, {text: 'Hello there!'}, msg.key.remoteJid)
            //         }
            //     }
            // }
        }
    );
    // messages updated like status delivered, message deleted etc.
    sock.ev.on('messages.update', (events) => {
            logger.info(events)
        }
    );
    sock.ev.on('message-receipt.update', (events) => {
            logger.info(events)
        }
    );
    sock.ev.on('messages.reaction', (events) => {
            logger.info(events)
        }
    );
    sock.ev.on('presence.update', (events) => {
            logger.info(events)
        }
    );
    sock.ev.on('chats.update', (events) => {
        logger.info(events)
    })


    return sock
}


module.exports = {startSock, sendMessageWTyping, getWhatsAppId, isGroup, saveStore}
