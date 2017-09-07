var copy = require('scp2');
var SSH = require('simple-ssh');
var fs = require('fs');
var conf = JSON.parse(fs.readFileSync('conf.json', 'utf8')).conf;

var baseurl = '/home/godotengine/godotengine.org-web/htdocs/themes/godotengine/assets'

// Copy css
copy.scp('./assets/packed/', `${conf.user}:${conf.password}@${conf.host}:${baseurl}/packed/`, function(err) {
  if (err) {
    console.log(err);
  } else {
    console.log('Copy success');
    changePermissions();
  }
})
  
 
// Handle any tasks that need to be done on remote
var ssh = new SSH({
    host: conf.host,
    user: conf.user,
    pass: conf.password
});
 
function changePermissions () {
  ssh.exec(`chmod g+rwx ${baseurl}/packed/*`, {
    out: function(stdout) {
        console.log(stdout);
    }}).start();
  ssh.exec(`chmod g+rwx ${baseurl}/packed`, {
      out: function(stdout) {
          console.log(stdout);
      },
    err: function(stderr) {
      console.log(stderr);
    }

  }).start();
}
   
