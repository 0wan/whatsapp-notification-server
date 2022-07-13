const pino = require("pino")()
const express = require('express')
const exceptionHandler = require('express-exception-handler')
const http = require('http')
const path = require('path')
const cors = require('cors')
const mongoose = require('mongoose')
const config = require('./config')
const routes = require('./routes');
const {startSock} = require("./whatsapp");

exceptionHandler.handle()

global.Whatsapp = undefined

const app = express()

app.use(cors())
app.use(express.json())
app.use(express.json({limit: '50mb'}))
app.use(express.urlencoded({extended: true}))
app.use('/', routes)

const server = app.listen(config.port, config.host, () => {
    startSock()
    pino.info(`Listening to ${config.host}:${config.port}`)
})

const exitClients = () => {

}

const UnexpectedExceptionHandler = (error) => {
    pino.error(error)
    exitClients()

    if (server) {
        server.close(() => {
            pino.info(`Server closed`)
            process.exit(1)
        })
    } else {
        process.exit(1)
    }
}

process.on('uncaughtException', UnexpectedExceptionHandler)
process.on('unhandledRejection', UnexpectedExceptionHandler)

process.on('SIGTERM', () => {
    pino.info(`SIGTERM received. Shutting down the server...`)
    exitClients()
    if (server) {
        server.close()
    }
})

module.exports = server
