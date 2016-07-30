/*
  Developer: Marzavec ( https://github.com/marzavec )
  Description: parsing engine template
*/

engineTemplate = {
  // main params //
  name: '',
  host: '',
  apiKey: null,

  // required //
  init: function(){
    //blCheck.lookupProviders.push(this); // <-- uncomment this //
  },

  // required //
  getDnsString: function(targetIP){
    var toReturn = targetIP.split('.').reverse().join('.') + '.' +
                   this.host;

    if(this.apiKey !== null) toReturn = this.apiKey + '.' + toReturn;

    return toReturn;
  },

  // required //
  parseReturn: function(data){
    var infoCodes = data.split('.');

    if(infoCodes[0] != '127') return false;

    var toReturn = [{ 'listed': true }];

    console.log(this.name + ' Parsing:');
    console.log(data);

    return toReturn;
  },

  // engine specific functions //
  temp: function(data){

  }
}

engineTemplate.init();
