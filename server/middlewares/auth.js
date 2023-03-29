//middlewares

const { decodeToken } = require("../helpers/helper");


const authentication = async (req, response, next) => {
  try {
    const { access_token } = req.headers;
    if (!access_token) {
      throw {
        name: "InvalidToken",
      };
    }

    const data = decodeToken(access_token);
   if(data.rd!=="Sukses"){
        throw {
            name: "InvalidToken",
        };
   }
    next();
  } catch (err) {
    console.log(err);
   response.status(401).json(err)
  }
};

module.exports = {
  authentication,
};
