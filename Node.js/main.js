/*
  Developer: Marzavec ( https://github.com/marzavec )
  Description: Multi-service blacklist check
*/

// set process title //
process.title = 'Blacklist Test';

// import node classes //
const fileSys = require('fs');
dns = require('dns'); // required by blCheck

// main import function //
// blocking function used to make sure everything is imported before init()s //
var importDirectory = function(targetDir){
  var fileList = fileSys.readdirSync(targetDir);
  fileList.forEach(function(targetFile){
    if(targetFile.substr(-3) == '.js'){
      targetFile = targetDir + targetFile;
      if(!fileSys.lstatSync(targetFile).isDirectory()) require(targetFile);
    }
  });
}

// import server classes //
importDirectory('./includes/');

// import server parsing modules //
importDirectory('./modules/');

// return function for when all lookups have finished //
var outputData = function(data){
  console.log('All reports gathered:');
  console.log(data);
}

// known spam server //
var spamIp = '127.1.1.0';

// start //
blCheck.startCheck(spamIp, outputData);
