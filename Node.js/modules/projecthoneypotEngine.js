/*
  Developer: Marzavec ( https://github.com/marzavec )
  Description: projectHoneyPot parsing engine
*/

projectHoneyPot = {
  // main params //
  name: 'Project Honey Pot',
  host: 'dnsbl.httpbl.org',
  apiKey: 'wmxxybgohcur',

  // required //
  init: function(){
    blCheck.lookupProviders.push(this);
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

    if(infoCodes[0] != '127') return 'API Error';

    var toReturn = {
      'listed': true,
      'type': null,
      'threatScore': 0,
      'lastSeen': infoCodes[1],
      'searchEngineName': ''
    };

    toReturn.type = this.parseType(infoCodes[3]);

    if(infoCodes[3] != 0){
      toReturn.threatScore = infoCodes[2];
    }else{
      toReturn.searchEngineName = this.getSEname(infoCodes[2]);
    }

    return toReturn;
  },

  // engine specific functions //
  parseType: function(data){
    var returnType = '';
    data = parseInt(data);

    if(data & 0) returnType += 'Search Engine, ';
    if(data & 1) returnType += 'Suspicious, ';
    if(data & 2) returnType += 'Harvester, ';
    if(data & 4) returnType += 'Comment Spammer, ';

    returnType = returnType.substr(0, returnType.length - 2);

    if(returnType == '') returnType = 'Search Engine';

    return returnType;
  },

  getSEname: function(data){
    switch(parseInt(data)){
      case 0: return 'Undocumented';
      case 1: return 'AltaVista';
      case 2: return 'Ask';
      case 3: return 'Baidu';
      case 4: return 'Excite';
      case 5: return 'Google';
      case 6: return 'Looksmart';
      case 7: return 'Lycos';
      case 8: return 'MSN';
      case 9: return 'Yahoo';
      case 10: return 'Cuil';
      case 11: return 'InfoSeek';
      case 12: return 'Miscellaneous';
    }
  }
}

projectHoneyPot.init();
