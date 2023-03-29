const axios = require('axios');
const { encodeToken } = require('../helpers/helper');

class Controller {
    static async login(req, response) {
        try {
            const { user, password } = req.body;
            const result = await axios({
                method: 'post',
                url: 'https://devel.bebasbayar.com:81/web/test_programmer.php',
                data: {
                    user: user,
                    password: password
                }
            })
            const access_token = encodeToken(result.data);
            console.log(access_token)
            response.status(200).json({access_token});
        } catch (err) {
            response.status(400).json(err);
        }
    }

    static async getData(req, response) {
        try {
            const res = await axios({
                method: 'get',
                url: 'https://devel.bebasbayar.com:81/web/test_programmer.php',
            })
            response.status(200).json(res.data);
        } catch (err) {
            response.status(500).json(err);
        }
    }
}

module.exports = Controller;