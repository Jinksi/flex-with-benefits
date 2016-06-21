#!/usr/bin/env node

var http = require('http');
var fs = require('fs');
var url = 'plae.thrv.xyz';
var theme = 'plae';

;(function(){

  if(!url || !theme){
      return console.log('rev [site-url] [theme-folder]')
  }

  if(url[0] !== 'h'){
    url = 'http://' + url;
  }

  function getRemote(){
    http.get(url + '/wp-content/themes/' + theme + '/VERSION', function(res){
      res.setEncoding('utf8');
      var str = '';
      res.on('data', function(chunk){
        str += chunk;
      });
      res.on('end', function(){

        var local = getLocal(str);

      });
      res.resume();
    }).on('error', function(e) {
      console.log('Got error: ' + e.message);
    });
  }

  function getLocal(remote){
    fs.readFile(__dirname + '/.git/refs/heads/master', 'utf8', function(err, data){
      if(err) console.log(err);
      if(data) {
        var local = data.substr(0, 7)
        if(local.trim() == remote.trim()){

          console.log('––––––––––––––––––––––––––')
          console.log('    all up to date 😁   ')
          console.log('––––––––––––––––––––––––––')

        } else if(remote.trim().length < 10 ) {
          console.log('–––––––––––––')
          console.log('mismatch!')
          console.log('local: ' + local.trim())
          console.log('remote: ' + remote.trim())
          console.log('trying again...')
          setTimeout(function(){
            getRemote()
          }, 5000)
        } else {

          console.log('––––––––––––––––––––––––––')
          console.log('    CRAZY ERROR!!!!! 😦   ')
          console.log('––––––––––––––––––––––––––')

        }
      }
    })
  }

  getRemote()

})();
