const response = (res, statusCode = 200, success = false, message = '', data = {}) => {
    res.status(statusCode)
    res.json({
        success,
        message,
        data,
    })

    res.end()
}

const ok = (res, message = '', data = {}) => {
    response(res, 200, true, message, data)
}

const fail = (res, message = '', data = {}, status = 500) => {
    response(res, status, false, message, data)
}

module.exports = {response, ok, fail}
