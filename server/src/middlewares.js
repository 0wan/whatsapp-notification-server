const {fail} = require("./response");

const AuthToken = (req, res, next) => {
    const token = req.query['token']?.toString()
    if (!token) {
        return fail(res, 'Auth Token Invalid', undefined, 403)
    }

    next()
}

module.exports = {AuthToken}
