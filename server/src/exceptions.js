const pino = require("pino")()

class ExceptionHandler extends Error {
    constructor({message, errors, status}) {
        super(message);
        this.name = this.constructor.name
        this.message = message
        this.errors = errors
        this.status = status
    }
}

class APIExceptionHandler extends ExceptionHandler {
    constructor({message, errors, status = 500}) {
        super({
            message,
            errors,
            status
        });
    }
}
