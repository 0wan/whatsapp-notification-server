const express = require('express')
const response = require("./response");
const {ok, fail} = require("./response");
const {AuthToken} = require("./middlewares");
const {sendMessageWTyping, getWhatsAppId} = require("./whatsapp");
const router = express.Router()

router.get('/', (req, res) => {
    ok(res, 'Server Up and Running')
})

/**
 * Message
 */
router.get('/message',  /*AuthToken,*/
    (req, res) => {
        ok(res, 'Messages query not available')
    }
)

router.post('/message',  /*AuthToken,*/
    (req, res, next) => {
        const phone = req.body.phone?.toString()
        const message = req.body.message?.toString()

        if (!phone || !message) {
            return fail(res, 'Format Data Invalid', undefined, 200);
        }

        next()
    },
    async (req, res) => {
        const phone = req.body.phone?.toString()
        const message = req.body.message?.toString()

        await sendMessageWTyping(Whatsapp, {text: message}, getWhatsAppId(phone))

        ok(res, 'Message(s) sent.')
    }
)


module.exports = router
