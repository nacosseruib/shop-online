  var Currency = {
       /*  "NGN":0.00262832,
        "USD":1.00, */
    rates: {
        "NGN":1.00,
        "USD":1.00,
        "EUR":1.18592,
        "GBP":1.32209,
        "CAD":0.76476,
        "ARS":0.0125072,
        "AUD":0.731987,
        "BRL":0.184486,
        "CLP":0.00130454,
        "CNY":0.151938,
        "CYP":0.397899,
        "CZK":0.0449073,
        "DKK":0.159265,
        "EEK":0.0706676,
        "HKD":0.128973,
        "HUF":0.0033009,
        "ISK":0.00735235,
        "INR":0.0134418,
        "JMD":0.00678474,
        "JPY":0.00956596,
        "LVL":1.57329,
        "LTL":0.320236,
        "MTL":0.293496,
        "MXN":0.0493532,
        "NZD":0.690696,
        "NOK":0.110408,
        "PLN":0.265319,
        "SGD":0.743382,
        "SKK":21.5517,
        "SIT":175.439,
        "ZAR":0.0652991,
        "KRW":0.000903072,
        "SEK":0.116045,
        "CHF":1.09604,
        "TWD":0.0350469,
        "UYU":0.0232697,
        "MYR":0.242851,
        "BSD":1.0,
        "CRC":0.00163013,
        "RON":0.243423,
        "PHP":0.0207508,
        "AED":0.272294,
        "VEB":0.000100125,
        "IDR":7.08882e-05,
        "TRY":0.129874,
        "THB":0.0331521,
        "TTD":0.147433,
        "ILS":0.297014,
        "SYP":0.00194964,
        "XCD":0.370029,
        "COP":0.000275107,
        "RUB":0.0130989,
        "HRK":0.156719,
        "KZT":0.00233058,
        "TZS":0.000431143,
        "XPT":905.384,
        "SAR":0.266667,
        "NIO":0.0286907,
        "LAK":0.000107889,
        "OMR":2.60078,
        "AMD":0.00207552,
        "CDF":0.000508895,
        "KPW":0.00111105,
        "SPL":6.0,
        "KES":0.00915423,
        "ZWD":0.00276319,
        "KHR":0.000246337,
        "MVR":0.064879,
        "GTQ":0.128564,
        "BZD":0.496433,
        "BYR":3.91391e-05,
        "LYD":0.735245,
        "DZD":0.00776177,
        "BIF":0.000515431,
        "GIP":1.32209,
        "BOB":0.145093,
        "XOF":0.00180792,
        "STD":4.80972e-05,
        "PGK":0.28549,
        "ERN":0.0666667,
        "MWK":0.0013169,
        "CUP":0.0377358,
        "GMD":0.019308,
        "CVE":0.0107547,
        "BTN":0.0134418,
        "XAF":0.00180792,
        "UGX":0.000270632,
        "MAD":0.109479,
        "MNT":0.0003534,
        "LSL":0.0652991,
        "XAG":24.7557,
        "TOP":0.437179,
        "SHP":1.32209,
        "RSD":0.0100882,
        "HTG":0.0157799,
        "MGA":0.000253438,
        "MZN":0.0135618,
        "FKP":1.32209,
        "BWP":0.0895757,
        "HNL":0.040751,
        "PYG":0.000142404,
        "JEP":1.32209,
        "EGP":0.0639031,
        "LBP":0.00066335,
        "ANG":0.558673,
        "WST":0.38866,
        "TVD":0.731987,
        "GYD":0.00477949,
        "GGP":1.32209,
        "NPR":0.00836194,
        "KMF":0.00241056,
        "IRR":2.37442e-05,
        "XPD":2349.47,
        "SRD":0.0706626,
        "TMM":5.71359e-05,
        "SZL":0.0652991,
        "MOP":0.125216,
        "BMD":1.0,"XPF":0.009938,"ETB":0.0264559,"JOD":1.41044,"MDL":0.0584804,"MRO":0.00269449,"YER":0.00399479,"BAM":0.60635,"AWG":0.558659,"PEN":0.272834,"VEF":0.100125,"SLL":9.77111e-05,"KYD":1.21952,"AOA":0.00150198,"TND":0.366039,"TJS":0.0884958,"SCR":0.0487625,"LKR":0.00540956,"DJF":0.00562516,"GNF":0.00010231,"VUV":0.00893052,"SDG":0.0180759,"IMP":1.32209,"GEL":0.303501,"FJD":0.478255,"DOP":0.0171083,"XDR":1.42293,"MUR":0.0248927,"MMK":0.000772053,"LRD":0.00638561,"BBD":0.5,"ZMK":4.78615e-05,"XAU":1889.43,"VND":4.27796e-05,"UAH":0.0355649,"TMT":0.285679,"IQD":0.000838477,"BGN":0.60635,"KGS":0.0117925,"RWF":0.00102261,"BHD":2.65957,"UZS":9.62171e-05,"PKR":0.00632591,"MKD":0.0192127,"AFN":0.0129461,"NAD":0.0652991,"BDT":0.011797,"AZN":0.588589,"SOS":0.00173368,"QAR":0.274725,"PAB":1.0,"CUC":1.0,"SVC":0.114286,"SBD":0.123742,"ALL":0.00956222,"BND":0.743382,"KWD":3.27425,"GHS":0.171644,"ZMW":0.0478615,"XBT":16990.5,"NTD":0.0337206,"BYN":0.391391,"CNH":0.152241,"MRU":0.0269449,"STN":0.0480972,"VES":1.53929e-06,"MXV":0.322594
    },
    convert: function(amount, from, to) {
      return (amount * this.rates[from]) / this.rates[to];
    }
  };