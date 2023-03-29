const express = require('express');
const router = express.Router()
const Controller=require('../controllers/Controller');
const { authentication } = require('../middlewares/auth');


router.post('/login',Controller.login);
router.get('/',authentication,Controller.getData);


module.exports=router;
