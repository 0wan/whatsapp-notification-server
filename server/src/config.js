const HOST = process.env.HOST || '0.0.0.0'
const PORT = parseInt(process.env.PORT ?? 3210)

const MONGODB = 'mongodb://127.0.0.1:27017/WhatsappNotificationServer'

module.exports = {
    host: HOST,
    port: PORT,
    mongoose: {
        url: MONGODB,
        options: {
            useNewUrlParser: true,
            useUnifiedTopology: true,
        },
    }
}
