/*
  Developer: Marzavec ( https://github.com/marzavec )
  Description: core checking class
*/

blCheck = {
  // main params //
  checking: false,
  targetIP: null,
  callback: null,
  lookupIndex: 0,

  // lookup servers array //
  lookupProviders: [],

  // final data //
  returnData: [],

  startCheck: function(targetIP, callback){
    this.targetIP = targetIP;
    this.callback = callback;

    this.checkNext();
  },

  checkNext: function(){
    var dnsString = this.lookupProviders[this.lookupIndex].getDnsString(this.targetIP);

    this.startLookup(dnsString);
  },

  startLookup: function(targetDNS){
    dns.lookup(targetDNS, this.lookupFinished);
  },

  lookupFinished: function(error, addresses, family){
    /*console.log(error);
    console.log(addresses);
    console.log(family);*/
    if(error != null){
      blCheck.returnData.push({
        'name': blCheck.lookupProviders[blCheck.lookupIndex].name,
        'data': false
      });
    }else{
      blCheck.returnData.push({
        'name': blCheck.lookupProviders[blCheck.lookupIndex].name,
        'data': blCheck.lookupProviders[blCheck.lookupIndex].parseReturn(addresses)
      });
    }

    blCheck.lookupIndex++;
    if(blCheck.lookupIndex == blCheck.lookupProviders.length){
      blCheck.callback(blCheck.returnData);
    }else{
      //this.checkNext();
    }
  }
}
