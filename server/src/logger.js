const pino = require("pino")

const dt = new Date()

const logger = pino(
    {
        transport: {
            target: 'pino-pretty',
            options: {
                colorize: true,
                levelFirst: true,
                translateTime: "yyyy-dd-mm, h:MM:ss TT",
                // destination: `./log_${dt.getFullYear()}_${dt.getMonth()}_${dt.getDate()}.log`,
            }
        }
    },    
);

module.exports = logger