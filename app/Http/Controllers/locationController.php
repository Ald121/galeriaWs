<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class locationController extends Controller
{

    public function getPaises(Request $request) {
    	
      $paises = DB::table('paises')->where('status','A')->get();
      return response()->json(["respuesta" => true,"paises" => $paises]);           	
    }

    public function getProvincias(Request $request) {
    	
      $provincias = DB::table('provincias')->where('status','A')->where('pais',$request->pais)->get();
      return response()->json(["respuesta" => true,"provincias" => $provincias ]);           	
    }

    public function getCiudades(Request $request) {
    	
      $ciudades = DB::table('ciudades')->where('status','A')->where('provincia',$request->provincia)->get();
      return response()->json(["respuesta" => true,"ciudades" => $ciudades ]);           	
    }

    public function genCiudadesProv(Request $request) {
		// $cities = [
		// 	  "1"=> [
		// 	    "provincia"=> "AZUAY",
		// 	    "cantones"=> [
		// 	      "101"=> [
		// 	        "canton"=> "CUENCA"
		// 	      ],
		// 	      "102"=> [
		// 	        "canton"=> "GIRÓN"
		// 	      ],
		// 	      "103"=> [
		// 	        "canton"=> "GUALACEO"
		// 	      ],
		// 	      "104"=> [
		// 	        "canton"=> "NABÓN"
		// 	      ],
		// 	      "105"=> [
		// 	        "canton"=> "PAUTE"
		// 	      ],
		// 	      "106"=> [
		// 	        "canton"=> "PUCARA"
		// 	      ],
		// 	      "107"=> [
		// 	        "canton"=> "SAN FERNANDO"
		// 	      ],
		// 	      "108"=> [
		// 	        "canton"=> "SANTA ISABEL"
		// 	      ],
		// 	      "109"=> [
		// 	        "canton"=> "SIGSIG"
		// 	      ],
		// 	      "110"=> [
		// 	        "canton"=> "OÑA"
		// 	      ],
		// 	      "111"=> [
		// 	        "canton"=> "CHORDELEG"
		// 	      ],
		// 	      "112"=> [
		// 	        "canton"=> "EL PAN"
		// 	      ],
		// 	      "113"=> [
		// 	        "canton"=> "SEVILLA DE ORO"
		// 	      ],
		// 	      "114"=> [
		// 	        "canton"=> "GUACHAPALA"
		// 	      ],
		// 	      "115"=> [
		// 	        "canton"=> "CAMILO PONCE ENRÍQUEZ"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "2"=> [
		// 	    "provincia"=> "BOLIVAR",
		// 	    "cantones"=> [
		// 	      "201"=> [
		// 	        "canton"=> "GUARANDA"
		// 	      ],
		// 	      "202"=> [
		// 	        "canton"=> "CHILLANES"
		// 	      ],
		// 	      "203"=> [
		// 	        "canton"=> "CHIMBO"
		// 	      ],
		// 	      "204"=> [
		// 	        "canton"=> "ECHEANDÍA"
		// 	      ],
		// 	      "205"=> [
		// 	        "canton"=> "SAN MIGUEL"
		// 	      ],
		// 	      "206"=> [
		// 	        "canton"=> "CALUMA"
		// 	      ],
		// 	      "207"=> [
		// 	        "canton"=> "LAS NAVES"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "3"=> [
		// 	    "provincia"=> "CAÑAR",
		// 	    "cantones"=> [
		// 	      "301"=> [
		// 	        "canton"=> "AZOGUES"
		// 	      ],
		// 	      "302"=> [
		// 	        "canton"=> "BIBLIÁN"
		// 	      ],
		// 	      "303"=> [
		// 	        "canton"=> "CAÑAR"
		// 	      ],
		// 	      "304"=> [
		// 	        "canton"=> "LA TRONCAL"
		// 	      ],
		// 	      "305"=> [
		// 	        "canton"=> "EL TAMBO"
		// 	      ],
		// 	      "306"=> [
		// 	        "canton"=> "DÉLEG"
		// 	      ],
		// 	      "307"=> [
		// 	        "canton"=> "SUSCAL"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "4"=> [
		// 	    "provincia"=> "CARCHI",
		// 	    "cantones"=> [
		// 	      "401"=> [
		// 	        "canton"=> "TULCÁN"
		// 	      ],
		// 	      "402"=> [
		// 	        "canton"=> "BOLÍVAR"
		// 	      ],
		// 	      "403"=> [
		// 	        "canton"=> "ESPEJO"
		// 	      ],
		// 	      "404"=> [
		// 	        "canton"=> "MIRA"
		// 	      ],
		// 	      "405"=> [
		// 	        "canton"=> "MONTÚFAR"
		// 	      ],
		// 	      "406"=> [
		// 	        "canton"=> "SAN PEDRO DE HUACA"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "5"=> [
		// 	    "provincia"=> "COTOPAXI",
		// 	    "cantones"=> [
		// 	      "501"=> [
		// 	        "canton"=> "LATACUNGA"
		// 	      ],
		// 	      "502"=> [
		// 	        "canton"=> "LA MANÁ"
		// 	      ],
		// 	      "503"=> [
		// 	        "canton"=> "PANGUA"
		// 	      ],
		// 	      "504"=> [
		// 	        "canton"=> "PUJILI"
		// 	      ],
		// 	      "505"=> [
		// 	        "canton"=> "SALCEDO"
		// 	      ],
		// 	      "506"=> [
		// 	        "canton"=> "SAQUISILÍ"
		// 	      ],
		// 	      "507"=> [
		// 	        "canton"=> "SIGCHOS"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "6"=> [
		// 	    "provincia"=> "CHIMBORAZO",
		// 	    "cantones"=> [
		// 	      "601"=> [
		// 	        "canton"=> "RIOBAMBA"
		// 	      ],
		// 	      "602"=> [
		// 	        "canton"=> "ALAUSI"
		// 	      ],
		// 	      "603"=> [
		// 	        "canton"=> "COLTA"
		// 	      ],
		// 	      "604"=> [
		// 	        "canton"=> "CHAMBO"
		// 	      ],
		// 	      "605"=> [
		// 	        "canton"=> "CHUNCHI"
		// 	      ],
		// 	      "606"=> [
		// 	        "canton"=> "GUAMOTE"
		// 	      ],
		// 	      "607"=> [
		// 	        "canton"=> "GUANO"
		// 	      ],
		// 	      "608"=> [
		// 	        "canton"=> "PALLATANGA"
		// 	      ],
		// 	      "609"=> [
		// 	        "canton"=> "PENIPE"
		// 	      ],
		// 	      "610"=> [
		// 	        "canton"=> "CUMANDÁ"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "7"=> [
		// 	    "provincia"=> "EL ORO",
		// 	    "cantones"=> [
		// 	      "701"=> [
		// 	        "canton"=> "MACHALA"
		// 	      ],
		// 	      "702"=> [
		// 	        "canton"=> "ARENILLAS"
		// 	      ],
		// 	      "703"=> [
		// 	        "canton"=> "ATAHUALPA"
		// 	      ],
		// 	      "704"=> [
		// 	        "canton"=> "BALSAS"
		// 	      ],
		// 	      "705"=> [
		// 	        "canton"=> "CHILLA"
		// 	      ],
		// 	      "706"=> [
		// 	        "canton"=> "EL GUABO"
		// 	      ],
		// 	      "707"=> [
		// 	        "canton"=> "HUAQUILLAS"
		// 	      ],
		// 	      "708"=> [
		// 	        "canton"=> "MARCABELÍ"
		// 	      ],
		// 	      "709"=> [
		// 	        "canton"=> "PASAJE"
		// 	      ],
		// 	      "710"=> [
		// 	        "canton"=> "PIÑAS"
		// 	      ],
		// 	      "711"=> [
		// 	        "canton"=> "PORTOVELO"
		// 	      ],
		// 	      "712"=> [
		// 	        "canton"=> "SANTA ROSA"
		// 	      ],
		// 	      "713"=> [
		// 	        "canton"=> "ZARUMA"
		// 	      ],
		// 	      "714"=> [
		// 	        "canton"=> "LAS LAJAS"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "8"=> [
		// 	    "provincia"=> "ESMERALDAS",
		// 	    "cantones"=> [
		// 	      "801"=> [
		// 	        "canton"=> "ESMERALDAS"
		// 	      ],
		// 	      "802"=> [
		// 	        "canton"=> "ELOY ALFARO"
		// 	      ],
		// 	      "803"=> [
		// 	        "canton"=> "MUISNE"
		// 	      ],
		// 	      "804"=> [
		// 	        "canton"=> "QUININDÉ"
		// 	      ],
		// 	      "805"=> [
		// 	        "canton"=> "SAN LORENZO"
		// 	      ],
		// 	      "806"=> [
		// 	        "canton"=> "ATACAMES"
		// 	      ],
		// 	      "807"=> [
		// 	        "canton"=> "RIOVERDE"
		// 	      ],
		// 	      "808"=> [
		// 	        "canton"=> "LA CONCORDIA"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "9"=> [
		// 	    "provincia"=> "GUAYAS",
		// 	    "cantones"=> [
		// 	      "901"=> [
		// 	        "canton"=> "GUAYAQUIL"
		// 	      ],
		// 	      "902"=> [
		// 	        "canton"=> "ALFREDO BAQUERIZO MORENO (JUJÁN)"
		// 	      ],
		// 	      "903"=> [
		// 	        "canton"=> "BALAO"
		// 	      ],
		// 	      "904"=> [
		// 	        "canton"=> "BALZAR"
		// 	      ],
		// 	      "905"=> [
		// 	        "canton"=> "COLIMES"
		// 	      ],
		// 	      "906"=> [
		// 	        "canton"=> "DAULE"
		// 	      ],
		// 	      "907"=> [
		// 	        "canton"=> "DURÁN"
		// 	      ],
		// 	      "908"=> [
		// 	        "canton"=> "EL EMPALME"
		// 	      ],
		// 	      "909"=> [
		// 	        "canton"=> "EL TRIUNFO"
		// 	      ],
		// 	      "910"=> [
		// 	        "canton"=> "MILAGRO"
		// 	      ],
		// 	      "911"=> [
		// 	        "canton"=> "NARANJAL"
		// 	      ],
		// 	      "912"=> [
		// 	        "canton"=> "NARANJITO"
		// 	      ],
		// 	      "913"=> [
		// 	        "canton"=> "PALESTINA"
		// 	      ],
		// 	      "914"=> [
		// 	        "canton"=> "PEDRO CARBO"
		// 	      ],
		// 	      "916"=> [
		// 	        "canton"=> "SAMBORONDÓN"
		// 	      ],
		// 	      "918"=> [
		// 	        "canton"=> "SANTA LUCÍA"
		// 	      ],
		// 	      "919"=> [
		// 	        "canton"=> "SALITRE (URBINA JADO)"
		// 	      ],
		// 	      "920"=> [
		// 	        "canton"=> "SAN JACINTO DE YAGUACHI"
		// 	      ],
		// 	      "921"=> [
		// 	        "canton"=> "PLAYAS"
		// 	      ],
		// 	      "922"=> [
		// 	        "canton"=> "SIMÓN BOLÍVAR"
		// 	      ],
		// 	      "923"=> [
		// 	        "canton"=> "CORONEL MARCELINO MARIDUEÑA"
		// 	      ],
		// 	      "924"=> [
		// 	        "canton"=> "LOMAS DE SARGENTILLO"
		// 	      ],
		// 	      "925"=> [
		// 	        "canton"=> "NOBOL"
		// 	      ],
		// 	      "927"=> [
		// 	        "canton"=> "GENERAL ANTONIO ELIZALDE"
		// 	      ],
		// 	      "928"=> [
		// 	        "canton"=> "ISIDRO AYORA"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "10"=> [
		// 	    "provincia"=> "IMBABURA",
		// 	    "cantones"=> [
		// 	      "1001"=> [
		// 	        "canton"=> "IBARRA"
		// 	      ],
		// 	      "1002"=> [
		// 	        "canton"=> "ANTONIO ANTE"
		// 	      ],
		// 	      "1003"=> [
		// 	        "canton"=> "COTACACHI"
		// 	      ],
		// 	      "1004"=> [
		// 	        "canton"=> "OTAVALO"
		// 	      ],
		// 	      "1005"=> [
		// 	        "canton"=> "PIMAMPIRO"
		// 	      ],
		// 	      "1006"=> [
		// 	        "canton"=> "SAN MIGUEL DE URCUQUÍ"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "11"=> [
		// 	    "provincia"=> "LOJA",
		// 	    "cantones"=> [
		// 	      "1101"=> [
		// 	        "canton"=> "LOJA"
		// 	      ],
		// 	      "1102"=> [
		// 	        "canton"=> "CALVAS"
		// 	      ],
		// 	      "1103"=> [
		// 	        "canton"=> "CATAMAYO"
		// 	      ],
		// 	      "1104"=> [
		// 	        "canton"=> "CELICA"
		// 	      ],
		// 	      "1105"=> [
		// 	        "canton"=> "CHAGUARPAMBA"
		// 	      ],
		// 	      "1106"=> [
		// 	        "canton"=> "ESPÍNDOLA"
		// 	      ],
		// 	      "1107"=> [
		// 	        "canton"=> "GONZANAMÁ"
		// 	      ],
		// 	      "1108"=> [
		// 	        "canton"=> "MACARÁ"
		// 	      ],
		// 	      "1109"=> [
		// 	        "canton"=> "PALTAS"
		// 	      ],
		// 	      "1110"=> [
		// 	        "canton"=> "PUYANGO"
		// 	      ],
		// 	      "1111"=> [
		// 	        "canton"=> "SARAGURO"
		// 	      ],
		// 	      "1112"=> [
		// 	        "canton"=> "SOZORANGA"
		// 	      ],
		// 	      "1113"=> [
		// 	        "canton"=> "ZAPOTILLO"
		// 	      ],
		// 	      "1114"=> [
		// 	        "canton"=> "PINDAL"
		// 	      ],
		// 	      "1115"=> [
		// 	        "canton"=> "QUILANGA"
		// 	      ],
		// 	      "1116"=> [
		// 	        "canton"=> "OLMEDO"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "12"=> [
		// 	    "provincia"=> "LOS RIOS",
		// 	    "cantones"=> [
		// 	      "1201"=> [
		// 	        "canton"=> "BABAHOYO"
		// 	      ],
		// 	      "1202"=> [
		// 	        "canton"=> "BABA"
		// 	      ],
		// 	      "1203"=> [
		// 	        "canton"=> "MONTALVO"
		// 	      ],
		// 	      "1204"=> [
		// 	        "canton"=> "PUEBLOVIEJO"
		// 	      ],
		// 	      "1205"=> [
		// 	        "canton"=> "QUEVEDO"
		// 	      ],
		// 	      "1206"=> [
		// 	        "canton"=> "URDANETA"
		// 	      ],
		// 	      "1207"=> [
		// 	        "canton"=> "VENTANAS"
		// 	      ],
		// 	      "1208"=> [
		// 	        "canton"=> "VÍNCES"
		// 	      ],
		// 	      "1209"=> [
		// 	        "canton"=> "PALENQUE"
		// 	      ],
		// 	      "1210"=> [
		// 	        "canton"=> "BUENA FÉ"
		// 	      ],
		// 	      "1211"=> [
		// 	        "canton"=> "VALENCIA"
		// 	      ],
		// 	      "1212"=> [
		// 	        "canton"=> "MOCACHE"
		// 	      ],
		// 	      "1213"=> [
		// 	        "canton"=> "QUINSALOMA"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "13"=> [
		// 	    "provincia"=> "MANABI",
		// 	    "cantones"=> [
		// 	      "1301"=> [
		// 	        "canton"=> "PORTOVIEJO"
		// 	      ],
		// 	      "1302"=> [
		// 	        "canton"=> "BOLÍVAR"
		// 	      ],
		// 	      "1303"=> [
		// 	        "canton"=> "CHONE"
		// 	      ],
		// 	      "1304"=> [
		// 	        "canton"=> "EL CARMEN"
		// 	      ],
		// 	      "1305"=> [
		// 	        "canton"=> "FLAVIO ALFARO"
		// 	      ],
		// 	      "1306"=> [
		// 	        "canton"=> "JIPIJAPA"
		// 	      ],
		// 	      "1307"=> [
		// 	        "canton"=> "JUNÍN"
		// 	      ],
		// 	      "1308"=> [
		// 	        "canton"=> "MANTA"
		// 	      ],
		// 	      "1309"=> [
		// 	        "canton"=> "MONTECRISTI"
		// 	      ],
		// 	      "1310"=> [
		// 	        "canton"=> "PAJÁN"
		// 	      ],
		// 	      "1311"=> [
		// 	        "canton"=> "PICHINCHA"
		// 	      ],
		// 	      "1312"=> [
		// 	        "canton"=> "ROCAFUERTE"
		// 	      ],
		// 	      "1313"=> [
		// 	        "canton"=> "SANTA ANA"
		// 	      ],
		// 	      "1314"=> [
		// 	        "canton"=> "SUCRE"
		// 	      ],
		// 	      "1315"=> [
		// 	        "canton"=> "TOSAGUA"
		// 	      ],
		// 	      "1316"=> [
		// 	        "canton"=> "24 DE MAYO"
		// 	      ],
		// 	      "1317"=> [
		// 	        "canton"=> "PEDERNALES"
		// 	      ],
		// 	      "1318"=> [
		// 	        "canton"=> "OLMEDO"
		// 	      ],
		// 	      "1319"=> [
		// 	        "canton"=> "PUERTO LÓPEZ"
		// 	      ],
		// 	      "1320"=> [
		// 	        "canton"=> "JAMA"
		// 	      ],
		// 	      "1321"=> [
		// 	        "canton"=> "JARAMIJÓ"
		// 	      ],
		// 	      "1322"=> [
		// 	        "canton"=> "SAN VICENTE"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "14"=> [
		// 	    "provincia"=> "MORONA SANTIAGO",
		// 	    "cantones"=> [
		// 	      "1401"=> [
		// 	        "canton"=> "MORONA"
		// 	      ],
		// 	      "1402"=> [
		// 	        "canton"=> "GUALAQUIZA"
		// 	      ],
		// 	      "1403"=> [
		// 	        "canton"=> "LIMÓN INDANZA"
		// 	      ],
		// 	      "1404"=> [
		// 	        "canton"=> "PALORA"
		// 	      ],
		// 	      "1405"=> [
		// 	        "canton"=> "SANTIAGO"
		// 	      ],
		// 	      "1406"=> [
		// 	        "canton"=> "SUCÚA"
		// 	      ],
		// 	      "1407"=> [
		// 	        "canton"=> "HUAMBOYA"
		// 	      ],
		// 	      "1408"=> [
		// 	        "canton"=> "SAN JUAN BOSCO"
		// 	      ],
		// 	      "1409"=> [
		// 	        "canton"=> "TAISHA"
		// 	      ],
		// 	      "1410"=> [
		// 	        "canton"=> "LOGROÑO"
		// 	      ],
		// 	      "1411"=> [
		// 	        "canton"=> "PABLO SEXTO"
		// 	      ],
		// 	      "1412"=> [
		// 	        "canton"=> "TIWINTZA"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "15"=> [
		// 	    "provincia"=> "NAPO",
		// 	    "cantones"=> [
		// 	      "1501"=> [
		// 	        "canton"=> "TENA"
		// 	      ],
		// 	      "1503"=> [
		// 	        "canton"=> "ARCHIDONA"
		// 	      ],
		// 	      "1504"=> [
		// 	        "canton"=> "EL CHACO"
		// 	      ],
		// 	      "1507"=> [
		// 	        "canton"=> "QUIJOS"
		// 	      ],
		// 	      "1509"=> [
		// 	        "canton"=> "CARLOS JULIO AROSEMENA TOLA"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "16"=> [
		// 	    "provincia"=> "PASTAZA",
		// 	    "cantones"=> [
		// 	      "1601"=> [
		// 	        "canton"=> "PASTAZA"
		// 	      ],
		// 	      "1602"=> [
		// 	        "canton"=> "MERA"
		// 	      ],
		// 	      "1603"=> [
		// 	        "canton"=> "SANTA CLARA"
		// 	      ],
		// 	      "1604"=> [
		// 	        "canton"=> "ARAJUNO"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "17"=> [
		// 	    "provincia"=> "PICHINCHA",
		// 	    "cantones"=> [
		// 	      "1701"=> [
		// 	        "canton"=> "QUITO"
		// 	      ],
		// 	      "1702"=> [
		// 	        "canton"=> "CAYAMBE"
		// 	      ],
		// 	      "1703"=> [
		// 	        "canton"=> "MEJIA"
		// 	      ],
		// 	      "1704"=> [
		// 	        "canton"=> "PEDRO MONCAYO"
		// 	      ],
		// 	      "1705"=> [
		// 	        "canton"=> "RUMIÑAHUI"
		// 	      ],
		// 	      "1707"=> [
		// 	        "canton"=> "SAN MIGUEL DE LOS BANCOS"
		// 	      ],
		// 	      "1708"=> [
		// 	        "canton"=> "PEDRO VICENTE MALDONADO"
		// 	      ],
		// 	      "1709"=> [
		// 	        "canton"=> "PUERTO QUITO"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "18"=> [
		// 	    "provincia"=> "TUNGURAHUA",
		// 	    "cantones"=> [
		// 	      "1801"=> [
		// 	        "canton"=> "AMBATO"
		// 	      ],
		// 	      "1802"=> [
		// 	        "canton"=> "BAÑOS DE AGUA SANTA"
		// 	      ],
		// 	      "1803"=> [
		// 	        "canton"=> "CEVALLOS"
		// 	      ],
		// 	      "1804"=> [
		// 	        "canton"=> "MOCHA"
		// 	      ],
		// 	      "1805"=> [
		// 	        "canton"=> "PATATE"
		// 	      ],
		// 	      "1806"=> [
		// 	        "canton"=> "QUERO"
		// 	      ],
		// 	      "1807"=> [
		// 	        "canton"=> "SAN PEDRO DE PELILEO"
		// 	      ],
		// 	      "1808"=> [
		// 	        "canton"=> "SANTIAGO DE PÍLLARO"
		// 	      ],
		// 	      "1809"=> [
		// 	        "canton"=> "TISALEO"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "19"=> [
		// 	    "provincia"=> "ZAMORA CHINCHIPE",
		// 	    "cantones"=> [
		// 	      "1901"=> [
		// 	        "canton"=> "ZAMORA"
		// 	      ],
		// 	      "1902"=> [
		// 	        "canton"=> "CHINCHIPE"
		// 	      ],
		// 	      "1903"=> [
		// 	        "canton"=> "NANGARITZA"
		// 	      ],
		// 	      "1904"=> [
		// 	        "canton"=> "YACUAMBI"
		// 	      ],
		// 	      "1905"=> [
		// 	        "canton"=> "YANTZAZA (YANZATZA)"
		// 	      ],
		// 	      "1906"=> [
		// 	        "canton"=> "EL PANGUI"
		// 	      ],
		// 	      "1907"=> [
		// 	        "canton"=> "CENTINELA DEL CÓNDOR"
		// 	      ],
		// 	      "1908"=> [
		// 	        "canton"=> "PALANDA"
		// 	      ],
		// 	      "1909"=> [
		// 	        "canton"=> "PAQUISHA"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "20"=> [
		// 	    "provincia"=> "GALAPAGOS",
		// 	    "cantones"=> [
		// 	      "2001"=> [
		// 	        "canton"=> "SAN CRISTÓBAL"
		// 	      ],
		// 	      "2002"=> [
		// 	        "canton"=> "ISABELA"
		// 	      ],
		// 	      "2003"=> [
		// 	        "canton"=> "SANTA CRUZ"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "21"=> [
		// 	    "provincia"=> "SUCUMBIOS",
		// 	    "cantones"=> [
		// 	      "2101"=> [
		// 	        "canton"=> "LAGO AGRIO"
		// 	      ],
		// 	      "2102"=> [
		// 	        "canton"=> "GONZALO PIZARRO"
		// 	      ],
		// 	      "2103"=> [
		// 	        "canton"=> "PUTUMAYO"
		// 	      ],
		// 	      "2104"=> [
		// 	        "canton"=> "SHUSHUFINDI"
		// 	      ],
		// 	      "2105"=> [
		// 	        "canton"=> "SUCUMBÍOS"
		// 	      ],
		// 	      "2106"=> [
		// 	        "canton"=> "CASCALES"
		// 	      ],
		// 	      "2107"=> [
		// 	        "canton"=> "CUYABENO"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "22"=> [
		// 	    "provincia"=> "ORELLANA",
		// 	    "cantones"=> [
		// 	      "2201"=> [
		// 	        "canton"=> "ORELLANA"
		// 	      ],
		// 	      "2202"=> [
		// 	        "canton"=> "AGUARICO"
		// 	      ],
		// 	      "2203"=> [
		// 	        "canton"=> "LA JOYA DE LOS SACHAS"
		// 	      ],
		// 	      "2204"=> [
		// 	        "canton"=> "LORETO"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "23"=> [
		// 	    "provincia"=> "SANTO DOMINGO DE LOS TSACHILAS",
		// 	    "cantones"=> [
		// 	      "2301"=> [
		// 	        "canton"=> "SANTO DOMINGO"
		// 	      ]
		// 	    ]
		// 	  ],
		// 	  "24"=> [
		// 	    "provincia"=> "SANTA ELENA",
		// 	    "cantones"=> [
		// 	      "2401"=> [
		// 	        "canton"=> "SANTA ELENA"
		// 	      ],
		// 	      "2402"=> [
		// 	        "canton"=> "LA LIBERTAD"
		// 	      ],
		// 	      "2403"=> [
		// 	        "canton"=> "SALINAS"
		// 	      ]
		// 	    ]
		// 	  ]
		// 	  // ,
		// 	  // "90"=> [
		// 	  //   "cantones"=> [
		// 	  //     "9001"=> [
		// 	  //       "canton"=> "LAS GOLONDRINAS"
		// 	  //     ],
		// 	  //     "9003"=> [
		// 	  //       "canton"=> "MANGA DEL CURA"
		// 	  //     ],
		// 	  //     "9004"=> [
		// 	  //       "canton"=> "EL PIEDRERO"
		// 	  //     ]
		// 	  //   ]
		// 	  // ]
		// ];

		$cities = [ [
	"inegi_id"=> 20246,
	"id"=> 246,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Cajonos"
], [
	"inegi_id"=> 20247,
	"id"=> 247,
	"state_id"=> "Oaxaca",
	"name"=> "Capulálpam de Méndez"
], [
	"inegi_id"=> 20248,
	"id"=> 248,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo del Mar"
], [
	"inegi_id"=> 20249,
	"id"=> 249,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Yoloxochitlán"
], [
	"inegi_id"=> 20250,
	"id"=> 250,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Etlatongo"
], [
	"inegi_id"=> 20251,
	"id"=> 251,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Nejápam"
], [
	"inegi_id"=> 20252,
	"id"=> 252,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Peñasco"
], [
	"inegi_id"=> 20253,
	"id"=> 253,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Piñas"
], [
	"inegi_id"=> 20254,
	"id"=> 254,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Río Hondo"
], [
	"inegi_id"=> 20255,
	"id"=> 255,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Sindihui"
], [
	"inegi_id"=> 20256,
	"id"=> 256,
	"state_id"=> "Oaxaca",
	"name"=> "San Mateo Tlapiltepec"
], [
	"inegi_id"=> 20257,
	"id"=> 257,
	"state_id"=> "Oaxaca",
	"name"=> "San Melchor Betaza"
], [
	"inegi_id"=> 20258,
	"id"=> 258,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Achiutla"
], [
	"inegi_id"=> 20259,
	"id"=> 259,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Ahuehuetitlán"
], [
	"inegi_id"=> 20260,
	"id"=> 260,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Aloápam"
], [
	"inegi_id"=> 20261,
	"id"=> 261,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Amatitlán"
], [
	"inegi_id"=> 20262,
	"id"=> 262,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Amatlán"
], [
	"inegi_id"=> 20263,
	"id"=> 263,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Coatlán"
], [
	"inegi_id"=> 20264,
	"id"=> 264,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Chicahua"
], [
	"inegi_id"=> 20265,
	"id"=> 265,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Chimalapa"
], [
	"inegi_id"=> 20266,
	"id"=> 266,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel del Puerto"
], [
	"inegi_id"=> 20267,
	"id"=> 267,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel del Río"
], [
	"inegi_id"=> 20268,
	"id"=> 268,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Ejutla"
], [
	"inegi_id"=> 20269,
	"id"=> 269,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel el Grande"
], [
	"inegi_id"=> 20270,
	"id"=> 270,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Huautla"
], [
	"inegi_id"=> 20271,
	"id"=> 271,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Mixtepec"
], [
	"inegi_id"=> 20272,
	"id"=> 272,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Panixtlahuaca"
], [
	"inegi_id"=> 20273,
	"id"=> 273,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Peras"
], [
	"inegi_id"=> 20274,
	"id"=> 274,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Piedras"
], [
	"inegi_id"=> 20275,
	"id"=> 275,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Quetzaltepec"
], [
	"inegi_id"=> 20276,
	"id"=> 276,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Santa Flor"
], [
	"inegi_id"=> 20277,
	"id"=> 277,
	"state_id"=> "Oaxaca",
	"name"=> "Villa Sola de Vega"
], [
	"inegi_id"=> 20278,
	"id"=> 278,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Soyaltepec"
], [
	"inegi_id"=> 20279,
	"id"=> 279,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Suchixtepec"
], [
	"inegi_id"=> 20280,
	"id"=> 280,
	"state_id"=> "Oaxaca",
	"name"=> "Villa Talea de Castro"
], [
	"inegi_id"=> 20281,
	"id"=> 281,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Tecomatlán"
], [
	"inegi_id"=> 20282,
	"id"=> 282,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Tenango"
], [
	"inegi_id"=> 20283,
	"id"=> 283,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Tequixtepec"
], [
	"inegi_id"=> 20284,
	"id"=> 284,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Tilquiápam"
], [
	"inegi_id"=> 20285,
	"id"=> 285,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Tlacamama"
], [
	"inegi_id"=> 20286,
	"id"=> 286,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Tlacotepec"
], [
	"inegi_id"=> 20287,
	"id"=> 287,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Tulancingo"
], [
	"inegi_id"=> 20288,
	"id"=> 288,
	"state_id"=> "Oaxaca",
	"name"=> "San Miguel Yotao"
], [
	"inegi_id"=> 20289,
	"id"=> 289,
	"state_id"=> "Oaxaca",
	"name"=> "San Nicolás"
], [
	"inegi_id"=> 20290,
	"id"=> 290,
	"state_id"=> "Oaxaca",
	"name"=> "San Nicolás Hidalgo"
], [
	"inegi_id"=> 20291,
	"id"=> 291,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Coatlán"
], [
	"inegi_id"=> 20292,
	"id"=> 292,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Cuatro Venados"
], [
	"inegi_id"=> 20293,
	"id"=> 293,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Etla"
], [
	"inegi_id"=> 20294,
	"id"=> 294,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Huitzo"
], [
	"inegi_id"=> 20295,
	"id"=> 295,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Huixtepec"
], [
	"inegi_id"=> 20296,
	"id"=> 296,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Macuiltianguis"
], [
	"inegi_id"=> 20297,
	"id"=> 297,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Tijaltepec"
], [
	"inegi_id"=> 20298,
	"id"=> 298,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Villa de Mitla"
], [
	"inegi_id"=> 20299,
	"id"=> 299,
	"state_id"=> "Oaxaca",
	"name"=> "San Pablo Yaganiza"
], [
	"inegi_id"=> 20300,
	"id"=> 300,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Amuzgos"
], [
	"inegi_id"=> 20301,
	"id"=> 301,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Apóstol"
], [
	"inegi_id"=> 20302,
	"id"=> 302,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Atoyac"
], [
	"inegi_id"=> 20303,
	"id"=> 303,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Cajonos"
], [
	"inegi_id"=> 20304,
	"id"=> 304,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Coxcaltepec Cántaros"
], [
	"inegi_id"=> 20305,
	"id"=> 305,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Comitancillo"
], [
	"inegi_id"=> 20306,
	"id"=> 306,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro el Alto"
], [
	"inegi_id"=> 20307,
	"id"=> 307,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Huamelula"
], [
	"inegi_id"=> 20308,
	"id"=> 308,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Huilotepec"
], [
	"inegi_id"=> 20309,
	"id"=> 309,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Ixcatlán"
], [
	"inegi_id"=> 20310,
	"id"=> 310,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Ixtlahuaca"
], [
	"inegi_id"=> 20311,
	"id"=> 311,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Jaltepetongo"
], [
	"inegi_id"=> 20312,
	"id"=> 312,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Jicayán"
], [
	"inegi_id"=> 20313,
	"id"=> 313,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Jocotipac"
], [
	"inegi_id"=> 20314,
	"id"=> 314,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Juchatengo"
], [
	"inegi_id"=> 20315,
	"id"=> 315,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Mártir"
], [
	"inegi_id"=> 20316,
	"id"=> 316,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Mártir Quiechapa"
], [
	"inegi_id"=> 20317,
	"id"=> 317,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Mártir Yucuxaco"
], [
	"inegi_id"=> 20318,
	"id"=> 318,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Mixtepec - Dto. 22 -"
], [
	"inegi_id"=> 20319,
	"id"=> 319,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Mixtepec - Dto. 26 -"
], [
	"inegi_id"=> 20320,
	"id"=> 320,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Molinos"
], [
	"inegi_id"=> 20321,
	"id"=> 321,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Nopala"
], [
	"inegi_id"=> 20322,
	"id"=> 322,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Ocopetatillo"
], [
	"inegi_id"=> 20323,
	"id"=> 323,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Ocotepec"
], [
	"inegi_id"=> 20324,
	"id"=> 324,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Pochutla"
], [
	"inegi_id"=> 20325,
	"id"=> 325,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Quiatoni"
], [
	"inegi_id"=> 20326,
	"id"=> 326,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Sochiápam"
], [
	"inegi_id"=> 20327,
	"id"=> 327,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Tapanatepec"
], [
	"inegi_id"=> 20328,
	"id"=> 328,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Taviche"
], [
	"inegi_id"=> 20329,
	"id"=> 329,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Teozacoalco"
], [
	"inegi_id"=> 20330,
	"id"=> 330,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Teutila"
], [
	"inegi_id"=> 20331,
	"id"=> 331,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Tidaá"
], [
	"inegi_id"=> 20332,
	"id"=> 332,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Topiltepec"
], [
	"inegi_id"=> 20333,
	"id"=> 333,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Totolapa"
], [
	"inegi_id"=> 20334,
	"id"=> 334,
	"state_id"=> "Oaxaca",
	"name"=> "Villa de Tututepec de Melchor Ocampo"
], [
	"inegi_id"=> 20335,
	"id"=> 335,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Yaneri"
], [
	"inegi_id"=> 20336,
	"id"=> 336,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Yólox"
], [
	"inegi_id"=> 20337,
	"id"=> 337,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro y San Pablo Ayutla"
], [
	"inegi_id"=> 20338,
	"id"=> 338,
	"state_id"=> "Oaxaca",
	"name"=> "Villa de Etla"
], [
	"inegi_id"=> 20339,
	"id"=> 339,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro y San Pablo Teposcolula"
], [
	"inegi_id"=> 20340,
	"id"=> 340,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro y San Pablo Tequixtepec"
], [
	"inegi_id"=> 20341,
	"id"=> 341,
	"state_id"=> "Oaxaca",
	"name"=> "San Pedro Yucunama"
], [
	"inegi_id"=> 20342,
	"id"=> 342,
	"state_id"=> "Oaxaca",
	"name"=> "San Raymundo Jalpan"
], [
	"inegi_id"=> 20343,
	"id"=> 343,
	"state_id"=> "Oaxaca",
	"name"=> "San Sebastián Abasolo"
], [
	"inegi_id"=> 20344,
	"id"=> 344,
	"state_id"=> "Oaxaca",
	"name"=> "San Sebastián Coatlán"
], [
	"inegi_id"=> 20345,
	"id"=> 345,
	"state_id"=> "Oaxaca",
	"name"=> "San Sebastián Ixcapa"
], [
	"inegi_id"=> 20346,
	"id"=> 346,
	"state_id"=> "Oaxaca",
	"name"=> "San Sebastián Nicananduta"
], [
	"inegi_id"=> 20347,
	"id"=> 347,
	"state_id"=> "Oaxaca",
	"name"=> "San Sebastián Río Hondo"
], [
	"inegi_id"=> 20348,
	"id"=> 348,
	"state_id"=> "Oaxaca",
	"name"=> "San Sebastián Tecomaxtlahuaca"
], [
	"inegi_id"=> 20349,
	"id"=> 349,
	"state_id"=> "Oaxaca",
	"name"=> "San Sebastián Teitipac"
], [
	"inegi_id"=> 20350,
	"id"=> 350,
	"state_id"=> "Oaxaca",
	"name"=> "San Sebastián Tutla"
], [
	"inegi_id"=> 20351,
	"id"=> 351,
	"state_id"=> "Oaxaca",
	"name"=> "San Simón Almolongas"
], [
	"inegi_id"=> 20352,
	"id"=> 352,
	"state_id"=> "Oaxaca",
	"name"=> "San Simón Zahuatlán"
], [
	"inegi_id"=> 20353,
	"id"=> 353,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Ana"
], [
	"inegi_id"=> 20354,
	"id"=> 354,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Ana Ateixtlahuaca"
], [
	"inegi_id"=> 20355,
	"id"=> 355,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Ana Cuauhtémoc"
], [
	"inegi_id"=> 20356,
	"id"=> 356,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Ana del Valle"
], [
	"inegi_id"=> 20357,
	"id"=> 357,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Ana Tavela"
], [
	"inegi_id"=> 20358,
	"id"=> 358,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Ana Tlapacoyan"
], [
	"inegi_id"=> 20359,
	"id"=> 359,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Ana Yareni"
], [
	"inegi_id"=> 20360,
	"id"=> 360,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Ana Zegache"
], [
	"inegi_id"=> 20361,
	"id"=> 361,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catalina Quierí"
], [
	"inegi_id"=> 20362,
	"id"=> 362,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Cuixtla"
], [
	"inegi_id"=> 20363,
	"id"=> 363,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Ixtepeji"
], [
	"inegi_id"=> 20364,
	"id"=> 364,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Juquila"
], [
	"inegi_id"=> 20365,
	"id"=> 365,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Lachatao"
], [
	"inegi_id"=> 20366,
	"id"=> 366,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Loxicha"
], [
	"inegi_id"=> 20367,
	"id"=> 367,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Mechoacán"
], [
	"inegi_id"=> 20368,
	"id"=> 368,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Minas"
], [
	"inegi_id"=> 20369,
	"id"=> 369,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Quiané"
], [
	"inegi_id"=> 20370,
	"id"=> 370,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Tayata"
], [
	"inegi_id"=> 20371,
	"id"=> 371,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Ticuá"
], [
	"inegi_id"=> 20372,
	"id"=> 372,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Yosonotú"
], [
	"inegi_id"=> 20373,
	"id"=> 373,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Catarina Zapoquila"
], [
	"inegi_id"=> 20374,
	"id"=> 374,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Acatepec"
], [
	"inegi_id"=> 20375,
	"id"=> 375,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Amilpas"
], [
	"inegi_id"=> 20376,
	"id"=> 376,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz de Bravo"
], [
	"inegi_id"=> 20377,
	"id"=> 377,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Itundujia"
], [
	"inegi_id"=> 20378,
	"id"=> 378,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Mixtepec"
], [
	"inegi_id"=> 20379,
	"id"=> 379,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Nundaco"
], [
	"inegi_id"=> 20380,
	"id"=> 380,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Papalutla"
], [
	"inegi_id"=> 20381,
	"id"=> 381,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Tacache de Mina"
], [
	"inegi_id"=> 20382,
	"id"=> 382,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Tacahua"
], [
	"inegi_id"=> 20383,
	"id"=> 383,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Tayata"
], [
	"inegi_id"=> 20384,
	"id"=> 384,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Xitla"
], [
	"inegi_id"=> 20385,
	"id"=> 385,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Xoxocotlán"
], [
	"inegi_id"=> 20386,
	"id"=> 386,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Cruz Zenzontepec"
], [
	"inegi_id"=> 20387,
	"id"=> 387,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Gertrudis"
], [
	"inegi_id"=> 20388,
	"id"=> 388,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Inés del Monte"
], [
	"inegi_id"=> 20389,
	"id"=> 389,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Inés Yatzeche"
], [
	"inegi_id"=> 20390,
	"id"=> 390,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Lucía del Camino"
], [
	"inegi_id"=> 20391,
	"id"=> 391,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Lucía Miahuatlán"
], [
	"inegi_id"=> 20392,
	"id"=> 392,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Lucía Monteverde"
], [
	"inegi_id"=> 20393,
	"id"=> 393,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Lucía Ocotlán"
], [
	"inegi_id"=> 20394,
	"id"=> 394,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Alotepec"
], [
	"inegi_id"=> 20395,
	"id"=> 395,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Apazco"
], [
	"inegi_id"=> 20396,
	"id"=> 396,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María la Asunción"
], [
	"inegi_id"=> 20397,
	"id"=> 397,
	"state_id"=> "Oaxaca",
	"name"=> "Heroica Ciudad de Tlaxiaco"
], [
	"inegi_id"=> 20398,
	"id"=> 398,
	"state_id"=> "Oaxaca",
	"name"=> "Ayoquezco de Aldama"
], [
	"inegi_id"=> 20399,
	"id"=> 399,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Atzompa"
], [
	"inegi_id"=> 20400,
	"id"=> 400,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Camotlán"
], [
	"inegi_id"=> 20401,
	"id"=> 401,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Colotepec"
], [
	"inegi_id"=> 20402,
	"id"=> 402,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Cortijo"
], [
	"inegi_id"=> 20403,
	"id"=> 403,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Coyotepec"
], [
	"inegi_id"=> 20404,
	"id"=> 404,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Chachoápam"
], [
	"inegi_id"=> 20405,
	"id"=> 405,
	"state_id"=> "Oaxaca",
	"name"=> "Villa de Chilapa de Díaz"
], [
	"inegi_id"=> 20406,
	"id"=> 406,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Chilchotla"
], [
	"inegi_id"=> 20407,
	"id"=> 407,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Chimalapa"
], [
	"inegi_id"=> 20408,
	"id"=> 408,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María del Rosario"
], [
	"inegi_id"=> 20409,
	"id"=> 409,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María del Tule"
], [
	"inegi_id"=> 20410,
	"id"=> 410,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Ecatepec"
], [
	"inegi_id"=> 20411,
	"id"=> 411,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Guelacé"
], [
	"inegi_id"=> 20412,
	"id"=> 412,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Guienagati"
], [
	"inegi_id"=> 20413,
	"id"=> 413,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Huatulco"
], [
	"inegi_id"=> 20414,
	"id"=> 414,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Huazolotitlán"
], [
	"inegi_id"=> 20415,
	"id"=> 415,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Ipalapa"
], [
	"inegi_id"=> 20416,
	"id"=> 416,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Ixcatlán"
], [
	"inegi_id"=> 20417,
	"id"=> 417,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Jacatepec"
], [
	"inegi_id"=> 20418,
	"id"=> 418,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Jalapa del Marqués"
], [
	"inegi_id"=> 20419,
	"id"=> 419,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Jaltianguis"
], [
	"inegi_id"=> 20420,
	"id"=> 420,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Lachixío"
], [
	"inegi_id"=> 20421,
	"id"=> 421,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Mixtequilla"
], [
	"inegi_id"=> 20422,
	"id"=> 422,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Nativitas"
], [
	"inegi_id"=> 20423,
	"id"=> 423,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Nduayaco"
], [
	"inegi_id"=> 20424,
	"id"=> 424,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Ozolotepec"
], [
	"inegi_id"=> 20425,
	"id"=> 425,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Pápalo"
], [
	"inegi_id"=> 20426,
	"id"=> 426,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Peñoles"
], [
	"inegi_id"=> 20427,
	"id"=> 427,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Petapa"
], [
	"inegi_id"=> 20428,
	"id"=> 428,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Quiegolani"
], [
	"inegi_id"=> 20429,
	"id"=> 429,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Sola"
], [
	"inegi_id"=> 20430,
	"id"=> 430,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Tataltepec"
], [
	"inegi_id"=> 20431,
	"id"=> 431,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Tecomavaca"
], [
	"inegi_id"=> 20432,
	"id"=> 432,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Temaxcalapa"
], [
	"inegi_id"=> 20433,
	"id"=> 433,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Temaxcaltepec"
], [
	"inegi_id"=> 20434,
	"id"=> 434,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Teopoxco"
], [
	"inegi_id"=> 20435,
	"id"=> 435,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Tepantlali"
], [
	"inegi_id"=> 20436,
	"id"=> 436,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Texcatitlán"
], [
	"inegi_id"=> 20437,
	"id"=> 437,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Tlahuitoltepec"
], [
	"inegi_id"=> 20438,
	"id"=> 438,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Tlalixtac"
], [
	"inegi_id"=> 20439,
	"id"=> 439,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Tonameca"
], [
	"inegi_id"=> 20440,
	"id"=> 440,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Totolapilla"
], [
	"inegi_id"=> 20441,
	"id"=> 441,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Xadani"
], [
	"inegi_id"=> 20442,
	"id"=> 442,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Yalina"
], [
	"inegi_id"=> 20443,
	"id"=> 443,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Yavesía"
], [
	"inegi_id"=> 20444,
	"id"=> 444,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Yolotepec"
], [
	"inegi_id"=> 20445,
	"id"=> 445,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Yosoyúa"
], [
	"inegi_id"=> 20446,
	"id"=> 446,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Yucuhiti"
], [
	"inegi_id"=> 20447,
	"id"=> 447,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Zacatepec"
], [
	"inegi_id"=> 20448,
	"id"=> 448,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Zaniza"
], [
	"inegi_id"=> 20449,
	"id"=> 449,
	"state_id"=> "Oaxaca",
	"name"=> "Santa María Zoquitlán"
], [
	"inegi_id"=> 20450,
	"id"=> 450,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Amoltepec"
], [
	"inegi_id"=> 20451,
	"id"=> 451,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Apoala"
], [
	"inegi_id"=> 20452,
	"id"=> 452,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Apóstol"
], [
	"inegi_id"=> 20453,
	"id"=> 453,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Astata"
], [
	"inegi_id"=> 20454,
	"id"=> 454,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Atitlán"
], [
	"inegi_id"=> 20455,
	"id"=> 455,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Ayuquililla"
], [
	"inegi_id"=> 20456,
	"id"=> 456,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Cacaloxtepec"
], [
	"inegi_id"=> 20457,
	"id"=> 457,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Camotlán"
], [
	"inegi_id"=> 20458,
	"id"=> 458,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Comaltepec"
], [
	"inegi_id"=> 20459,
	"id"=> 459,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Chazumba"
], [
	"inegi_id"=> 20460,
	"id"=> 460,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Choápam"
], [
	"inegi_id"=> 20461,
	"id"=> 461,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago del Río"
], [
	"inegi_id"=> 20462,
	"id"=> 462,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Huajolotitlán"
], [
	"inegi_id"=> 20463,
	"id"=> 463,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Huauclilla"
], [
	"inegi_id"=> 20464,
	"id"=> 464,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Ihuitlán Plumas"
], [
	"inegi_id"=> 20465,
	"id"=> 465,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Ixcuintepec"
], [
	"inegi_id"=> 20466,
	"id"=> 466,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Ixtayutla"
], [
	"inegi_id"=> 20467,
	"id"=> 467,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Jamiltepec"
], [
	"inegi_id"=> 20468,
	"id"=> 468,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Jocotepec"
], [
	"inegi_id"=> 20469,
	"id"=> 469,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Juxtlahuaca"
], [
	"inegi_id"=> 20470,
	"id"=> 470,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Lachiguiri"
], [
	"inegi_id"=> 20471,
	"id"=> 471,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Lalopa"
], [
	"inegi_id"=> 20472,
	"id"=> 472,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Laollaga"
], [
	"inegi_id"=> 20473,
	"id"=> 473,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Laxopa"
], [
	"inegi_id"=> 20474,
	"id"=> 474,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Llano Grande"
], [
	"inegi_id"=> 20475,
	"id"=> 475,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Matatlán"
], [
	"inegi_id"=> 20476,
	"id"=> 476,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Miltepec"
], [
	"inegi_id"=> 20477,
	"id"=> 477,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Minas"
], [
	"inegi_id"=> 20478,
	"id"=> 478,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Nacaltepec"
], [
	"inegi_id"=> 20479,
	"id"=> 479,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Nejapilla"
], [
	"inegi_id"=> 20480,
	"id"=> 480,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Nundiche"
], [
	"inegi_id"=> 20481,
	"id"=> 481,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Nuyoó"
], [
	"inegi_id"=> 20482,
	"id"=> 482,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Pinotepa Nacional"
], [
	"inegi_id"=> 20483,
	"id"=> 483,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Suchilquitongo"
], [
	"inegi_id"=> 20484,
	"id"=> 484,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Tamazola"
], [
	"inegi_id"=> 20485,
	"id"=> 485,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Tapextla"
], [
	"inegi_id"=> 20486,
	"id"=> 486,
	"state_id"=> "Oaxaca",
	"name"=> "Villa Tejúpam de la Unión"
], [
	"inegi_id"=> 20487,
	"id"=> 487,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Tenango"
], [
	"inegi_id"=> 20488,
	"id"=> 488,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Tepetlapa"
], [
	"inegi_id"=> 20489,
	"id"=> 489,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Tetepec"
], [
	"inegi_id"=> 20490,
	"id"=> 490,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Texcalcingo"
], [
	"inegi_id"=> 20491,
	"id"=> 491,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Textitlán"
], [
	"inegi_id"=> 20492,
	"id"=> 492,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Tilantongo"
], [
	"inegi_id"=> 20493,
	"id"=> 493,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Tillo"
], [
	"inegi_id"=> 20494,
	"id"=> 494,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Tlazoyaltepec"
], [
	"inegi_id"=> 20495,
	"id"=> 495,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Xanica"
], [
	"inegi_id"=> 20496,
	"id"=> 496,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Xiacuí"
], [
	"inegi_id"=> 20497,
	"id"=> 497,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Yaitepec"
], [
	"inegi_id"=> 20498,
	"id"=> 498,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Yaveo"
], [
	"inegi_id"=> 20499,
	"id"=> 499,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Yolomécatl"
], [
	"inegi_id"=> 20500,
	"id"=> 500,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Yosondúa"
], [
	"inegi_id"=> 20501,
	"id"=> 501,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Yucuyachi"
], [
	"inegi_id"=> 20502,
	"id"=> 502,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Zacatepec"
], [
	"inegi_id"=> 20503,
	"id"=> 503,
	"state_id"=> "Oaxaca",
	"name"=> "Santiago Zoochila"
], [
	"inegi_id"=> 20504,
	"id"=> 504,
	"state_id"=> "Oaxaca",
	"name"=> "Nuevo Zoquiápam"
], [
	"inegi_id"=> 20505,
	"id"=> 505,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Ingenio"
], [
	"inegi_id"=> 20506,
	"id"=> 506,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Albarradas"
], [
	"inegi_id"=> 20507,
	"id"=> 507,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Armenta"
], [
	"inegi_id"=> 20508,
	"id"=> 508,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Chihuitán"
], [
	"inegi_id"=> 20509,
	"id"=> 509,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo de Morelos"
], [
	"inegi_id"=> 20510,
	"id"=> 510,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Ixcatlán"
], [
	"inegi_id"=> 20511,
	"id"=> 511,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Nuxaá"
], [
	"inegi_id"=> 20512,
	"id"=> 512,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Ozolotepec"
], [
	"inegi_id"=> 20513,
	"id"=> 513,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Petapa"
], [
	"inegi_id"=> 20514,
	"id"=> 514,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Roayaga"
], [
	"inegi_id"=> 20515,
	"id"=> 515,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Tehuantepec"
], [
	"inegi_id"=> 20516,
	"id"=> 516,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Teojomulco"
], [
	"inegi_id"=> 20517,
	"id"=> 517,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Tepuxtepec"
], [
	"inegi_id"=> 20518,
	"id"=> 518,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Tlatayápam"
], [
	"inegi_id"=> 20519,
	"id"=> 519,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Tomaltepec"
], [
	"inegi_id"=> 20520,
	"id"=> 520,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Tonalá"
], [
	"inegi_id"=> 20521,
	"id"=> 521,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Tonaltepec"
], [
	"inegi_id"=> 20522,
	"id"=> 522,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Xagacía"
], [
	"inegi_id"=> 20523,
	"id"=> 523,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Yanhuitlán"
], [
	"inegi_id"=> 20524,
	"id"=> 524,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Yodohino"
], [
	"inegi_id"=> 20525,
	"id"=> 525,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Domingo Zanatepec"
], [
	"inegi_id"=> 20526,
	"id"=> 526,
	"state_id"=> "Oaxaca",
	"name"=> "Santos Reyes Nopala"
], [
	"inegi_id"=> 20527,
	"id"=> 527,
	"state_id"=> "Oaxaca",
	"name"=> "Santos Reyes Pápalo"
], [
	"inegi_id"=> 20528,
	"id"=> 528,
	"state_id"=> "Oaxaca",
	"name"=> "Santos Reyes Tepejillo"
], [
	"inegi_id"=> 20529,
	"id"=> 529,
	"state_id"=> "Oaxaca",
	"name"=> "Santos Reyes Yucuná"
], [
	"inegi_id"=> 20530,
	"id"=> 530,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Tomás Jalieza"
], [
	"inegi_id"=> 20531,
	"id"=> 531,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Tomás Mazaltepec"
], [
	"inegi_id"=> 20532,
	"id"=> 532,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Tomás Ocotepec"
], [
	"inegi_id"=> 20533,
	"id"=> 533,
	"state_id"=> "Oaxaca",
	"name"=> "Santo Tomás Tamazulapan"
], [
	"inegi_id"=> 20534,
	"id"=> 534,
	"state_id"=> "Oaxaca",
	"name"=> "San Vicente Coatlán"
], [
	"inegi_id"=> 20535,
	"id"=> 535,
	"state_id"=> "Oaxaca",
	"name"=> "San Vicente Lachixío"
], [
	"inegi_id"=> 20536,
	"id"=> 536,
	"state_id"=> "Oaxaca",
	"name"=> "San Vicente Nuñú"
], [
	"inegi_id"=> 20537,
	"id"=> 537,
	"state_id"=> "Oaxaca",
	"name"=> "Silacayoápam"
], [
	"inegi_id"=> 20538,
	"id"=> 538,
	"state_id"=> "Oaxaca",
	"name"=> "Sitio de Xitlapehua"
], [
	"inegi_id"=> 20539,
	"id"=> 539,
	"state_id"=> "Oaxaca",
	"name"=> "Soledad Etla"
], [
	"inegi_id"=> 20540,
	"id"=> 540,
	"state_id"=> "Oaxaca",
	"name"=> "Villa de Tamazulápam del Progreso"
], [
	"inegi_id"=> 20541,
	"id"=> 541,
	"state_id"=> "Oaxaca",
	"name"=> "Tanetze de Zaragoza"
], [
	"inegi_id"=> 20542,
	"id"=> 542,
	"state_id"=> "Oaxaca",
	"name"=> "Taniche"
], [
	"inegi_id"=> 20543,
	"id"=> 543,
	"state_id"=> "Oaxaca",
	"name"=> "Tataltepec de Valdés"
], [
	"inegi_id"=> 20544,
	"id"=> 544,
	"state_id"=> "Oaxaca",
	"name"=> "Teococuilco de Marcos Pérez"
], [
	"inegi_id"=> 20545,
	"id"=> 545,
	"state_id"=> "Oaxaca",
	"name"=> "Teotitlán de Flores Magón"
], [
	"inegi_id"=> 20546,
	"id"=> 546,
	"state_id"=> "Oaxaca",
	"name"=> "Teotitlán del Valle"
], [
	"inegi_id"=> 20547,
	"id"=> 547,
	"state_id"=> "Oaxaca",
	"name"=> "Teotongo"
], [
	"inegi_id"=> 20548,
	"id"=> 548,
	"state_id"=> "Oaxaca",
	"name"=> "Tepelmeme Villa de Morelos"
], [
	"inegi_id"=> 20549,
	"id"=> 549,
	"state_id"=> "Oaxaca",
	"name"=> "Tezoatlán de Segura y Luna"
], [
	"inegi_id"=> 20550,
	"id"=> 550,
	"state_id"=> "Oaxaca",
	"name"=> "San Jerónimo Tlacochahuaya"
], [
	"inegi_id"=> 20551,
	"id"=> 551,
	"state_id"=> "Oaxaca",
	"name"=> "Tlacolula de Matamoros"
], [
	"inegi_id"=> 20552,
	"id"=> 552,
	"state_id"=> "Oaxaca",
	"name"=> "Tlacotepec Plumas"
], [
	"inegi_id"=> 20553,
	"id"=> 553,
	"state_id"=> "Oaxaca",
	"name"=> "Tlalixtac de Cabrera"
], [
	"inegi_id"=> 20554,
	"id"=> 554,
	"state_id"=> "Oaxaca",
	"name"=> "Totontepec Villa de Morelos"
], [
	"inegi_id"=> 20555,
	"id"=> 555,
	"state_id"=> "Oaxaca",
	"name"=> "Trinidad Zaachila"
], [
	"inegi_id"=> 20556,
	"id"=> 556,
	"state_id"=> "Oaxaca",
	"name"=> "La Trinidad Vista Hermosa"
], [
	"inegi_id"=> 20557,
	"id"=> 557,
	"state_id"=> "Oaxaca",
	"name"=> "Unión Hidalgo"
], [
	"inegi_id"=> 20558,
	"id"=> 558,
	"state_id"=> "Oaxaca",
	"name"=> "Valerio Trujano"
], [
	"inegi_id"=> 20559,
	"id"=> 559,
	"state_id"=> "Oaxaca",
	"name"=> "San Juan Bautista Valle Nacional"
], [
	"inegi_id"=> 20560,
	"id"=> 560,
	"state_id"=> "Oaxaca",
	"name"=> "Villa Díaz Ordaz"
], [
	"inegi_id"=> 20561,
	"id"=> 561,
	"state_id"=> "Oaxaca",
	"name"=> "Yaxe"
], [
	"inegi_id"=> 20562,
	"id"=> 562,
	"state_id"=> "Oaxaca",
	"name"=> "Magdalena Yodocono de Porfirio Díaz"
], [
	"inegi_id"=> 20563,
	"id"=> 563,
	"state_id"=> "Oaxaca",
	"name"=> "Yogana"
], [
	"inegi_id"=> 20564,
	"id"=> 564,
	"state_id"=> "Oaxaca",
	"name"=> "Yutanduchi de Guerrero"
], [
	"inegi_id"=> 20565,
	"id"=> 565,
	"state_id"=> "Oaxaca",
	"name"=> "Villa de Zaachila"
], [
	"inegi_id"=> 20566,
	"id"=> 566,
	"state_id"=> "Oaxaca",
	"name"=> "Zapotitlán del Río"
], [
	"inegi_id"=> 20567,
	"id"=> 567,
	"state_id"=> "Oaxaca",
	"name"=> "Zapotitlán Lagunas"
], [
	"inegi_id"=> 20568,
	"id"=> 568,
	"state_id"=> "Oaxaca",
	"name"=> "Zapotitlán Palmas"
], [
	"inegi_id"=> 20569,
	"id"=> 569,
	"state_id"=> "Oaxaca",
	"name"=> "Santa Inés de Zaragoza"
], [
	"inegi_id"=> 20570,
	"id"=> 570,
	"state_id"=> "Oaxaca",
	"name"=> "Zimatlán de Álvarez"
], [
	"inegi_id"=> 21001,
	"id"=> 1,
	"state_id"=> "Puebla",
	"name"=> "Acajete"
], [
	"inegi_id"=> 21002,
	"id"=> 2,
	"state_id"=> "Puebla",
	"name"=> "Acateno"
], [
	"inegi_id"=> 21003,
	"id"=> 3,
	"state_id"=> "Puebla",
	"name"=> "Acatlán"
], [
	"inegi_id"=> 21004,
	"id"=> 4,
	"state_id"=> "Puebla",
	"name"=> "Acatzingo"
], [
	"inegi_id"=> 21005,
	"id"=> 5,
	"state_id"=> "Puebla",
	"name"=> "Acteopan"
], [
	"inegi_id"=> 21006,
	"id"=> 6,
	"state_id"=> "Puebla",
	"name"=> "Ahuacatlán"
], [
	"inegi_id"=> 21007,
	"id"=> 7,
	"state_id"=> "Puebla",
	"name"=> "Ahuatlán"
], [
	"inegi_id"=> 21008,
	"id"=> 8,
	"state_id"=> "Puebla",
	"name"=> "Ahuazotepec"
], [
	"inegi_id"=> 21009,
	"id"=> 9,
	"state_id"=> "Puebla",
	"name"=> "Ahuehuetitla"
], [
	"inegi_id"=> 21010,
	"id"=> 10,
	"state_id"=> "Puebla",
	"name"=> "Ajalpan"
], [
	"inegi_id"=> 21011,
	"id"=> 11,
	"state_id"=> "Puebla",
	"name"=> "Albino Zertuche"
], [
	"inegi_id"=> 21012,
	"id"=> 12,
	"state_id"=> "Puebla",
	"name"=> "Aljojuca"
], [
	"inegi_id"=> 21013,
	"id"=> 13,
	"state_id"=> "Puebla",
	"name"=> "Altepexi"
], [
	"inegi_id"=> 21014,
	"id"=> 14,
	"state_id"=> "Puebla",
	"name"=> "Amixtlán"
], [
	"inegi_id"=> 21015,
	"id"=> 15,
	"state_id"=> "Puebla",
	"name"=> "Amozoc"
], [
	"inegi_id"=> 21016,
	"id"=> 16,
	"state_id"=> "Puebla",
	"name"=> "Aquixtla"
], [
	"inegi_id"=> 21017,
	"id"=> 17,
	"state_id"=> "Puebla",
	"name"=> "Atempan"
], [
	"inegi_id"=> 21018,
	"id"=> 18,
	"state_id"=> "Puebla",
	"name"=> "Atexcal"
], [
	"inegi_id"=> 21019,
	"id"=> 19,
	"state_id"=> "Puebla",
	"name"=> "Atlixco"
], [
	"inegi_id"=> 21020,
	"id"=> 20,
	"state_id"=> "Puebla",
	"name"=> "Atoyatempan"
], [
	"inegi_id"=> 21021,
	"id"=> 21,
	"state_id"=> "Puebla",
	"name"=> "Atzala"
], [
	"inegi_id"=> 21022,
	"id"=> 22,
	"state_id"=> "Puebla",
	"name"=> "Atzitzihuacán"
], [
	"inegi_id"=> 21023,
	"id"=> 23,
	"state_id"=> "Puebla",
	"name"=> "Atzitzintla"
], [
	"inegi_id"=> 21024,
	"id"=> 24,
	"state_id"=> "Puebla",
	"name"=> "Axutla"
], [
	"inegi_id"=> 21025,
	"id"=> 25,
	"state_id"=> "Puebla",
	"name"=> "Ayotoxco de Guerrero"
], [
	"inegi_id"=> 21026,
	"id"=> 26,
	"state_id"=> "Puebla",
	"name"=> "Calpan"
], [
	"inegi_id"=> 21027,
	"id"=> 27,
	"state_id"=> "Puebla",
	"name"=> "Caltepec"
], [
	"inegi_id"=> 21028,
	"id"=> 28,
	"state_id"=> "Puebla",
	"name"=> "Camocuautla"
], [
	"inegi_id"=> 21029,
	"id"=> 29,
	"state_id"=> "Puebla",
	"name"=> "Caxhuacan"
], [
	"inegi_id"=> 21030,
	"id"=> 30,
	"state_id"=> "Puebla",
	"name"=> "Coatepec"
], [
	"inegi_id"=> 21031,
	"id"=> 31,
	"state_id"=> "Puebla",
	"name"=> "Coatzingo"
], [
	"inegi_id"=> 21032,
	"id"=> 32,
	"state_id"=> "Puebla",
	"name"=> "Cohetzala"
], [
	"inegi_id"=> 21033,
	"id"=> 33,
	"state_id"=> "Puebla",
	"name"=> "Cohuecan"
], [
	"inegi_id"=> 21034,
	"id"=> 34,
	"state_id"=> "Puebla",
	"name"=> "Coronango"
], [
	"inegi_id"=> 21035,
	"id"=> 35,
	"state_id"=> "Puebla",
	"name"=> "Coxcatlán"
], [
	"inegi_id"=> 21036,
	"id"=> 36,
	"state_id"=> "Puebla",
	"name"=> "Coyomeapan"
], [
	"inegi_id"=> 21037,
	"id"=> 37,
	"state_id"=> "Puebla",
	"name"=> "Coyotepec"
], [
	"inegi_id"=> 21038,
	"id"=> 38,
	"state_id"=> "Puebla",
	"name"=> "Cuapiaxtla de Madero"
], [
	"inegi_id"=> 21039,
	"id"=> 39,
	"state_id"=> "Puebla",
	"name"=> "Cuautempan"
], [
	"inegi_id"=> 21040,
	"id"=> 40,
	"state_id"=> "Puebla",
	"name"=> "Cuautinchán"
], [
	"inegi_id"=> 21041,
	"id"=> 41,
	"state_id"=> "Puebla",
	"name"=> "Cuautlancingo"
], [
	"inegi_id"=> 21042,
	"id"=> 42,
	"state_id"=> "Puebla",
	"name"=> "Cuayuca de Andrade"
], [
	"inegi_id"=> 21043,
	"id"=> 43,
	"state_id"=> "Puebla",
	"name"=> "Cuetzalan del Progreso"
], [
	"inegi_id"=> 21044,
	"id"=> 44,
	"state_id"=> "Puebla",
	"name"=> "Cuyoaco"
], [
	"inegi_id"=> 21045,
	"id"=> 45,
	"state_id"=> "Puebla",
	"name"=> "Chalchicomula de Sesma"
], [
	"inegi_id"=> 21046,
	"id"=> 46,
	"state_id"=> "Puebla",
	"name"=> "Chapulco"
], [
	"inegi_id"=> 21047,
	"id"=> 47,
	"state_id"=> "Puebla",
	"name"=> "Chiautla"
], [
	"inegi_id"=> 21048,
	"id"=> 48,
	"state_id"=> "Puebla",
	"name"=> "Chiautzingo"
], [
	"inegi_id"=> 21049,
	"id"=> 49,
	"state_id"=> "Puebla",
	"name"=> "Chiconcuautla"
], [
	"inegi_id"=> 21050,
	"id"=> 50,
	"state_id"=> "Puebla",
	"name"=> "Chichiquila"
], [
	"inegi_id"=> 21051,
	"id"=> 51,
	"state_id"=> "Puebla",
	"name"=> "Chietla"
], [
	"inegi_id"=> 21052,
	"id"=> 52,
	"state_id"=> "Puebla",
	"name"=> "Chigmecatitlán"
], [
	"inegi_id"=> 21053,
	"id"=> 53,
	"state_id"=> "Puebla",
	"name"=> "Chignahuapan"
], [
	"inegi_id"=> 21054,
	"id"=> 54,
	"state_id"=> "Puebla",
	"name"=> "Chignautla"
], [
	"inegi_id"=> 21055,
	"id"=> 55,
	"state_id"=> "Puebla",
	"name"=> "Chila"
], [
	"inegi_id"=> 21056,
	"id"=> 56,
	"state_id"=> "Puebla",
	"name"=> "Chila de la Sal"
], [
	"inegi_id"=> 21057,
	"id"=> 57,
	"state_id"=> "Puebla",
	"name"=> "Honey"
], [
	"inegi_id"=> 21058,
	"id"=> 58,
	"state_id"=> "Puebla",
	"name"=> "Chilchotla"
], [
	"inegi_id"=> 21059,
	"id"=> 59,
	"state_id"=> "Puebla",
	"name"=> "Chinantla"
], [
	"inegi_id"=> 21060,
	"id"=> 60,
	"state_id"=> "Puebla",
	"name"=> "Domingo Arenas"
], [
	"inegi_id"=> 21061,
	"id"=> 61,
	"state_id"=> "Puebla",
	"name"=> "Eloxochitlán"
], [
	"inegi_id"=> 21062,
	"id"=> 62,
	"state_id"=> "Puebla",
	"name"=> "Epatlán"
], [
	"inegi_id"=> 21063,
	"id"=> 63,
	"state_id"=> "Puebla",
	"name"=> "Esperanza"
], [
	"inegi_id"=> 21064,
	"id"=> 64,
	"state_id"=> "Puebla",
	"name"=> "Francisco Z. Mena"
], [
	"inegi_id"=> 21065,
	"id"=> 65,
	"state_id"=> "Puebla",
	"name"=> "General Felipe Ángeles"
], [
	"inegi_id"=> 21066,
	"id"=> 66,
	"state_id"=> "Puebla",
	"name"=> "Guadalupe"
], [
	"inegi_id"=> 21067,
	"id"=> 67,
	"state_id"=> "Puebla",
	"name"=> "Guadalupe Victoria"
], [
	"inegi_id"=> 21068,
	"id"=> 68,
	"state_id"=> "Puebla",
	"name"=> "Hermenegildo Galeana"
], [
	"inegi_id"=> 21069,
	"id"=> 69,
	"state_id"=> "Puebla",
	"name"=> "Huaquechula"
], [
	"inegi_id"=> 21070,
	"id"=> 70,
	"state_id"=> "Puebla",
	"name"=> "Huatlatlauca"
], [
	"inegi_id"=> 21071,
	"id"=> 71,
	"state_id"=> "Puebla",
	"name"=> "Huauchinango"
], [
	"inegi_id"=> 21072,
	"id"=> 72,
	"state_id"=> "Puebla",
	"name"=> "Huehuetla"
], [
	"inegi_id"=> 21073,
	"id"=> 73,
	"state_id"=> "Puebla",
	"name"=> "Huehuetlán el Chico"
], [
	"inegi_id"=> 21074,
	"id"=> 74,
	"state_id"=> "Puebla",
	"name"=> "Huejotzingo"
], [
	"inegi_id"=> 21075,
	"id"=> 75,
	"state_id"=> "Puebla",
	"name"=> "Hueyapan"
], [
	"inegi_id"=> 21076,
	"id"=> 76,
	"state_id"=> "Puebla",
	"name"=> "Hueytamalco"
], [
	"inegi_id"=> 21077,
	"id"=> 77,
	"state_id"=> "Puebla",
	"name"=> "Hueytlalpan"
], [
	"inegi_id"=> 21078,
	"id"=> 78,
	"state_id"=> "Puebla",
	"name"=> "Huitzilan de Serdán"
], [
	"inegi_id"=> 21079,
	"id"=> 79,
	"state_id"=> "Puebla",
	"name"=> "Huitziltepec"
], [
	"inegi_id"=> 21080,
	"id"=> 80,
	"state_id"=> "Puebla",
	"name"=> "Atlequizayán"
], [
	"inegi_id"=> 21081,
	"id"=> 81,
	"state_id"=> "Puebla",
	"name"=> "Ixcamilpa de Guerrero"
], [
	"inegi_id"=> 21082,
	"id"=> 82,
	"state_id"=> "Puebla",
	"name"=> "Ixcaquixtla"
], [
	"inegi_id"=> 21083,
	"id"=> 83,
	"state_id"=> "Puebla",
	"name"=> "Ixtacamaxtitlán"
], [
	"inegi_id"=> 21084,
	"id"=> 84,
	"state_id"=> "Puebla",
	"name"=> "Ixtepec"
], [
	"inegi_id"=> 21085,
	"id"=> 85,
	"state_id"=> "Puebla",
	"name"=> "Izúcar de Matamoros"
], [
	"inegi_id"=> 21086,
	"id"=> 86,
	"state_id"=> "Puebla",
	"name"=> "Jalpan"
], [
	"inegi_id"=> 21087,
	"id"=> 87,
	"state_id"=> "Puebla",
	"name"=> "Jolalpan"
], [
	"inegi_id"=> 21088,
	"id"=> 88,
	"state_id"=> "Puebla",
	"name"=> "Jonotla"
], [
	"inegi_id"=> 21089,
	"id"=> 89,
	"state_id"=> "Puebla",
	"name"=> "Jopala"
], [
	"inegi_id"=> 21090,
	"id"=> 90,
	"state_id"=> "Puebla",
	"name"=> "Juan C. Bonilla"
], [
	"inegi_id"=> 21091,
	"id"=> 91,
	"state_id"=> "Puebla",
	"name"=> "Juan Galindo"
], [
	"inegi_id"=> 21092,
	"id"=> 92,
	"state_id"=> "Puebla",
	"name"=> "Juan N. Méndez"
], [
	"inegi_id"=> 21093,
	"id"=> 93,
	"state_id"=> "Puebla",
	"name"=> "Lafragua"
], [
	"inegi_id"=> 21094,
	"id"=> 94,
	"state_id"=> "Puebla",
	"name"=> "Libres"
], [
	"inegi_id"=> 21095,
	"id"=> 95,
	"state_id"=> "Puebla",
	"name"=> "La Magdalena Tlatlauquitepec"
], [
	"inegi_id"=> 21096,
	"id"=> 96,
	"state_id"=> "Puebla",
	"name"=> "Mazapiltepec de Juárez"
], [
	"inegi_id"=> 21097,
	"id"=> 97,
	"state_id"=> "Puebla",
	"name"=> "Mixtla"
], [
	"inegi_id"=> 21098,
	"id"=> 98,
	"state_id"=> "Puebla",
	"name"=> "Molcaxac"
], [
	"inegi_id"=> 21099,
	"id"=> 99,
	"state_id"=> "Puebla",
	"name"=> "Cañada Morelos"
], [
	"inegi_id"=> 21100,
	"id"=> 100,
	"state_id"=> "Puebla",
	"name"=> "Naupan"
], [
	"inegi_id"=> 21101,
	"id"=> 101,
	"state_id"=> "Puebla",
	"name"=> "Nauzontla"
], [
	"inegi_id"=> 21102,
	"id"=> 102,
	"state_id"=> "Puebla",
	"name"=> "Nealtican"
], [
	"inegi_id"=> 21103,
	"id"=> 103,
	"state_id"=> "Puebla",
	"name"=> "Nicolás Bravo"
], [
	"inegi_id"=> 21104,
	"id"=> 104,
	"state_id"=> "Puebla",
	"name"=> "Nopalucan"
], [
	"inegi_id"=> 21105,
	"id"=> 105,
	"state_id"=> "Puebla",
	"name"=> "Ocotepec"
], [
	"inegi_id"=> 21106,
	"id"=> 106,
	"state_id"=> "Puebla",
	"name"=> "Ocoyucan"
], [
	"inegi_id"=> 21107,
	"id"=> 107,
	"state_id"=> "Puebla",
	"name"=> "Olintla"
], [
	"inegi_id"=> 21108,
	"id"=> 108,
	"state_id"=> "Puebla",
	"name"=> "Oriental"
], [
	"inegi_id"=> 21109,
	"id"=> 109,
	"state_id"=> "Puebla",
	"name"=> "Pahuatlán"
], [
	"inegi_id"=> 21110,
	"id"=> 110,
	"state_id"=> "Puebla",
	"name"=> "Palmar de Bravo"
], [
	"inegi_id"=> 21111,
	"id"=> 111,
	"state_id"=> "Puebla",
	"name"=> "Pantepec"
], [
	"inegi_id"=> 21112,
	"id"=> 112,
	"state_id"=> "Puebla",
	"name"=> "Petlalcingo"
], [
	"inegi_id"=> 21113,
	"id"=> 113,
	"state_id"=> "Puebla",
	"name"=> "Piaxtla"
], [
	"inegi_id"=> 21114,
	"id"=> 114,
	"state_id"=> "Puebla",
	"name"=> "Puebla"
], [
	"inegi_id"=> 21115,
	"id"=> 115,
	"state_id"=> "Puebla",
	"name"=> "Quecholac"
], [
	"inegi_id"=> 21116,
	"id"=> 116,
	"state_id"=> "Puebla",
	"name"=> "Quimixtlán"
], [
	"inegi_id"=> 21117,
	"id"=> 117,
	"state_id"=> "Puebla",
	"name"=> "Rafael Lara Grajales"
], [
	"inegi_id"=> 21118,
	"id"=> 118,
	"state_id"=> "Puebla",
	"name"=> "Los Reyes de Juárez"
], [
	"inegi_id"=> 21119,
	"id"=> 119,
	"state_id"=> "Puebla",
	"name"=> "San Andrés Cholula"
], [
	"inegi_id"=> 21120,
	"id"=> 120,
	"state_id"=> "Puebla",
	"name"=> "San Antonio Cañada"
], [
	"inegi_id"=> 21121,
	"id"=> 121,
	"state_id"=> "Puebla",
	"name"=> "San Diego la Mesa Tochimiltzingo"
], [
	"inegi_id"=> 21122,
	"id"=> 122,
	"state_id"=> "Puebla",
	"name"=> "San Felipe Teotlalcingo"
], [
	"inegi_id"=> 21123,
	"id"=> 123,
	"state_id"=> "Puebla",
	"name"=> "San Felipe Tepatlán"
], [
	"inegi_id"=> 21124,
	"id"=> 124,
	"state_id"=> "Puebla",
	"name"=> "San Gabriel Chilac"
], [
	"inegi_id"=> 21125,
	"id"=> 125,
	"state_id"=> "Puebla",
	"name"=> "San Gregorio Atzompa"
], [
	"inegi_id"=> 21126,
	"id"=> 126,
	"state_id"=> "Puebla",
	"name"=> "San Jerónimo Tecuanipan"
], [
	"inegi_id"=> 21127,
	"id"=> 127,
	"state_id"=> "Puebla",
	"name"=> "San Jerónimo Xayacatlán"
], [
	"inegi_id"=> 21128,
	"id"=> 128,
	"state_id"=> "Puebla",
	"name"=> "San José Chiapa"
], [
	"inegi_id"=> 21129,
	"id"=> 129,
	"state_id"=> "Puebla",
	"name"=> "San José Miahuatlán"
], [
	"inegi_id"=> 21130,
	"id"=> 130,
	"state_id"=> "Puebla",
	"name"=> "San Juan Atenco"
], [
	"inegi_id"=> 21131,
	"id"=> 131,
	"state_id"=> "Puebla",
	"name"=> "San Juan Atzompa"
], [
	"inegi_id"=> 21132,
	"id"=> 132,
	"state_id"=> "Puebla",
	"name"=> "San Martín Texmelucan"
], [
	"inegi_id"=> 21133,
	"id"=> 133,
	"state_id"=> "Puebla",
	"name"=> "San Martín Totoltepec"
], [
	"inegi_id"=> 21134,
	"id"=> 134,
	"state_id"=> "Puebla",
	"name"=> "San Matías Tlalancaleca"
], [
	"inegi_id"=> 21135,
	"id"=> 135,
	"state_id"=> "Puebla",
	"name"=> "San Miguel Ixitlán"
], [
	"inegi_id"=> 21136,
	"id"=> 136,
	"state_id"=> "Puebla",
	"name"=> "San Miguel Xoxtla"
], [
	"inegi_id"=> 21137,
	"id"=> 137,
	"state_id"=> "Puebla",
	"name"=> "San Nicolás Buenos Aires"
], [
	"inegi_id"=> 21138,
	"id"=> 138,
	"state_id"=> "Puebla",
	"name"=> "San Nicolás de los Ranchos"
], [
	"inegi_id"=> 21139,
	"id"=> 139,
	"state_id"=> "Puebla",
	"name"=> "San Pablo Anicano"
], [
	"inegi_id"=> 21140,
	"id"=> 140,
	"state_id"=> "Puebla",
	"name"=> "San Pedro Cholula"
], [
	"inegi_id"=> 21141,
	"id"=> 141,
	"state_id"=> "Puebla",
	"name"=> "San Pedro Yeloixtlahuaca"
], [
	"inegi_id"=> 21142,
	"id"=> 142,
	"state_id"=> "Puebla",
	"name"=> "San Salvador el Seco"
], [
	"inegi_id"=> 21143,
	"id"=> 143,
	"state_id"=> "Puebla",
	"name"=> "San Salvador el Verde"
], [
	"inegi_id"=> 21144,
	"id"=> 144,
	"state_id"=> "Puebla",
	"name"=> "San Salvador Huixcolotla"
], [
	"inegi_id"=> 21145,
	"id"=> 145,
	"state_id"=> "Puebla",
	"name"=> "San Sebastián Tlacotepec"
], [
	"inegi_id"=> 21146,
	"id"=> 146,
	"state_id"=> "Puebla",
	"name"=> "Santa Catarina Tlaltempan"
], [
	"inegi_id"=> 21147,
	"id"=> 147,
	"state_id"=> "Puebla",
	"name"=> "Santa Inés Ahuatempan"
], [
	"inegi_id"=> 21148,
	"id"=> 148,
	"state_id"=> "Puebla",
	"name"=> "Santa Isabel Cholula"
], [
	"inegi_id"=> 21149,
	"id"=> 149,
	"state_id"=> "Puebla",
	"name"=> "Santiago Miahuatlán"
], [
	"inegi_id"=> 21150,
	"id"=> 150,
	"state_id"=> "Puebla",
	"name"=> "Huehuetlán el Grande"
], [
	"inegi_id"=> 21151,
	"id"=> 151,
	"state_id"=> "Puebla",
	"name"=> "Santo Tomás Hueyotlipan"
], [
	"inegi_id"=> 21152,
	"id"=> 152,
	"state_id"=> "Puebla",
	"name"=> "Soltepec"
], [
	"inegi_id"=> 21153,
	"id"=> 153,
	"state_id"=> "Puebla",
	"name"=> "Tecali de Herrera"
], [
	"inegi_id"=> 21154,
	"id"=> 154,
	"state_id"=> "Puebla",
	"name"=> "Tecamachalco"
], [
	"inegi_id"=> 21155,
	"id"=> 155,
	"state_id"=> "Puebla",
	"name"=> "Tecomatlán"
], [
	"inegi_id"=> 21156,
	"id"=> 156,
	"state_id"=> "Puebla",
	"name"=> "Tehuacán"
], [
	"inegi_id"=> 21157,
	"id"=> 157,
	"state_id"=> "Puebla",
	"name"=> "Tehuitzingo"
], [
	"inegi_id"=> 21158,
	"id"=> 158,
	"state_id"=> "Puebla",
	"name"=> "Tenampulco"
], [
	"inegi_id"=> 21159,
	"id"=> 159,
	"state_id"=> "Puebla",
	"name"=> "Teopantlán"
], [
	"inegi_id"=> 21160,
	"id"=> 160,
	"state_id"=> "Puebla",
	"name"=> "Teotlalco"
], [
	"inegi_id"=> 21161,
	"id"=> 161,
	"state_id"=> "Puebla",
	"name"=> "Tepanco de López"
], [
	"inegi_id"=> 21162,
	"id"=> 162,
	"state_id"=> "Puebla",
	"name"=> "Tepango de Rodríguez"
], [
	"inegi_id"=> 21163,
	"id"=> 163,
	"state_id"=> "Puebla",
	"name"=> "Tepatlaxco de Hidalgo"
], [
	"inegi_id"=> 21164,
	"id"=> 164,
	"state_id"=> "Puebla",
	"name"=> "Tepeaca"
], [
	"inegi_id"=> 21165,
	"id"=> 165,
	"state_id"=> "Puebla",
	"name"=> "Tepemaxalco"
], [
	"inegi_id"=> 21166,
	"id"=> 166,
	"state_id"=> "Puebla",
	"name"=> "Tepeojuma"
], [
	"inegi_id"=> 21167,
	"id"=> 167,
	"state_id"=> "Puebla",
	"name"=> "Tepetzintla"
], [
	"inegi_id"=> 21168,
	"id"=> 168,
	"state_id"=> "Puebla",
	"name"=> "Tepexco"
], [
	"inegi_id"=> 21169,
	"id"=> 169,
	"state_id"=> "Puebla",
	"name"=> "Tepexi de Rodríguez"
], [
	"inegi_id"=> 21170,
	"id"=> 170,
	"state_id"=> "Puebla",
	"name"=> "Tepeyahualco"
], [
	"inegi_id"=> 21171,
	"id"=> 171,
	"state_id"=> "Puebla",
	"name"=> "Tepeyahualco de Cuauhtémoc"
], [
	"inegi_id"=> 21172,
	"id"=> 172,
	"state_id"=> "Puebla",
	"name"=> "Tetela de Ocampo"
], [
	"inegi_id"=> 21173,
	"id"=> 173,
	"state_id"=> "Puebla",
	"name"=> "Teteles de Ávila Castillo"
], [
	"inegi_id"=> 21174,
	"id"=> 174,
	"state_id"=> "Puebla",
	"name"=> "Teziutlán"
], [
	"inegi_id"=> 21175,
	"id"=> 175,
	"state_id"=> "Puebla",
	"name"=> "Tianguismanalco"
], [
	"inegi_id"=> 21176,
	"id"=> 176,
	"state_id"=> "Puebla",
	"name"=> "Tilapa"
], [
	"inegi_id"=> 21177,
	"id"=> 177,
	"state_id"=> "Puebla",
	"name"=> "Tlacotepec de Benito Juárez"
], [
	"inegi_id"=> 21178,
	"id"=> 178,
	"state_id"=> "Puebla",
	"name"=> "Tlacuilotepec"
], [
	"inegi_id"=> 21179,
	"id"=> 179,
	"state_id"=> "Puebla",
	"name"=> "Tlachichuca"
], [
	"inegi_id"=> 21180,
	"id"=> 180,
	"state_id"=> "Puebla",
	"name"=> "Tlahuapan"
], [
	"inegi_id"=> 21181,
	"id"=> 181,
	"state_id"=> "Puebla",
	"name"=> "Tlaltenango"
], [
	"inegi_id"=> 21182,
	"id"=> 182,
	"state_id"=> "Puebla",
	"name"=> "Tlanepantla"
], [
	"inegi_id"=> 21183,
	"id"=> 183,
	"state_id"=> "Puebla",
	"name"=> "Tlaola"
], [
	"inegi_id"=> 21184,
	"id"=> 184,
	"state_id"=> "Puebla",
	"name"=> "Tlapacoya"
], [
	"inegi_id"=> 21185,
	"id"=> 185,
	"state_id"=> "Puebla",
	"name"=> "Tlapanalá"
], [
	"inegi_id"=> 21186,
	"id"=> 186,
	"state_id"=> "Puebla",
	"name"=> "Tlatlauquitepec"
], [
	"inegi_id"=> 21187,
	"id"=> 187,
	"state_id"=> "Puebla",
	"name"=> "Tlaxco"
], [
	"inegi_id"=> 21188,
	"id"=> 188,
	"state_id"=> "Puebla",
	"name"=> "Tochimilco"
], [
	"inegi_id"=> 21189,
	"id"=> 189,
	"state_id"=> "Puebla",
	"name"=> "Tochtepec"
], [
	"inegi_id"=> 21190,
	"id"=> 190,
	"state_id"=> "Puebla",
	"name"=> "Totoltepec de Guerrero"
], [
	"inegi_id"=> 21191,
	"id"=> 191,
	"state_id"=> "Puebla",
	"name"=> "Tulcingo"
], [
	"inegi_id"=> 21192,
	"id"=> 192,
	"state_id"=> "Puebla",
	"name"=> "Tuzamapan de Galeana"
], [
	"inegi_id"=> 21193,
	"id"=> 193,
	"state_id"=> "Puebla",
	"name"=> "Tzicatlacoyan"
], [
	"inegi_id"=> 21194,
	"id"=> 194,
	"state_id"=> "Puebla",
	"name"=> "Venustiano Carranza"
], [
	"inegi_id"=> 21195,
	"id"=> 195,
	"state_id"=> "Puebla",
	"name"=> "Vicente Guerrero"
], [
	"inegi_id"=> 21196,
	"id"=> 196,
	"state_id"=> "Puebla",
	"name"=> "Xayacatlán de Bravo"
], [
	"inegi_id"=> 21197,
	"id"=> 197,
	"state_id"=> "Puebla",
	"name"=> "Xicotepec"
], [
	"inegi_id"=> 21198,
	"id"=> 198,
	"state_id"=> "Puebla",
	"name"=> "Xicotlán"
], [
	"inegi_id"=> 21199,
	"id"=> 199,
	"state_id"=> "Puebla",
	"name"=> "Xiutetelco"
], [
	"inegi_id"=> 21200,
	"id"=> 200,
	"state_id"=> "Puebla",
	"name"=> "Xochiapulco"
], [
	"inegi_id"=> 21201,
	"id"=> 201,
	"state_id"=> "Puebla",
	"name"=> "Xochiltepec"
], [
	"inegi_id"=> 21202,
	"id"=> 202,
	"state_id"=> "Puebla",
	"name"=> "Xochitlán de Vicente Suárez"
], [
	"inegi_id"=> 21203,
	"id"=> 203,
	"state_id"=> "Puebla",
	"name"=> "Xochitlán Todos Santos"
], [
	"inegi_id"=> 21204,
	"id"=> 204,
	"state_id"=> "Puebla",
	"name"=> "Yaonáhuac"
], [
	"inegi_id"=> 21205,
	"id"=> 205,
	"state_id"=> "Puebla",
	"name"=> "Yehualtepec"
], [
	"inegi_id"=> 21206,
	"id"=> 206,
	"state_id"=> "Puebla",
	"name"=> "Zacapala"
], [
	"inegi_id"=> 21207,
	"id"=> 207,
	"state_id"=> "Puebla",
	"name"=> "Zacapoaxtla"
], [
	"inegi_id"=> 21208,
	"id"=> 208,
	"state_id"=> "Puebla",
	"name"=> "Zacatlán"
], [
	"inegi_id"=> 21209,
	"id"=> 209,
	"state_id"=> "Puebla",
	"name"=> "Zapotitlán"
], [
	"inegi_id"=> 21210,
	"id"=> 210,
	"state_id"=> "Puebla",
	"name"=> "Zapotitlán de Méndez"
], [
	"inegi_id"=> 21211,
	"id"=> 211,
	"state_id"=> "Puebla",
	"name"=> "Zaragoza"
], [
	"inegi_id"=> 21212,
	"id"=> 212,
	"state_id"=> "Puebla",
	"name"=> "Zautla"
], [
	"inegi_id"=> 21213,
	"id"=> 213,
	"state_id"=> "Puebla",
	"name"=> "Zihuateutla"
], [
	"inegi_id"=> 21214,
	"id"=> 214,
	"state_id"=> "Puebla",
	"name"=> "Zinacatepec"
], [
	"inegi_id"=> 21215,
	"id"=> 215,
	"state_id"=> "Puebla",
	"name"=> "Zongozotla"
], [
	"inegi_id"=> 21216,
	"id"=> 216,
	"state_id"=> "Puebla",
	"name"=> "Zoquiapan"
], [
	"inegi_id"=> 21217,
	"id"=> 217,
	"state_id"=> "Puebla",
	"name"=> "Zoquitlán"
], [
	"inegi_id"=> 22001,
	"id"=> 1,
	"state_id"=> "Querétaro",
	"name"=> "Amealco de Bonfil"
], [
	"inegi_id"=> 22002,
	"id"=> 2,
	"state_id"=> "Querétaro",
	"name"=> "Pinal de Amoles"
], [
	"inegi_id"=> 22003,
	"id"=> 3,
	"state_id"=> "Querétaro",
	"name"=> "Arroyo Seco"
], [
	"inegi_id"=> 22004,
	"id"=> 4,
	"state_id"=> "Querétaro",
	"name"=> "Cadereyta de Montes"
], [
	"inegi_id"=> 22005,
	"id"=> 5,
	"state_id"=> "Querétaro",
	"name"=> "Colón"
], [
	"inegi_id"=> 22006,
	"id"=> 6,
	"state_id"=> "Querétaro",
	"name"=> "Corregidora"
], [
	"inegi_id"=> 22007,
	"id"=> 7,
	"state_id"=> "Querétaro",
	"name"=> "Ezequiel Montes"
], [
	"inegi_id"=> 22008,
	"id"=> 8,
	"state_id"=> "Querétaro",
	"name"=> "Huimilpan"
], [
	"inegi_id"=> 22009,
	"id"=> 9,
	"state_id"=> "Querétaro",
	"name"=> "Jalpan de Serra"
], [
	"inegi_id"=> 22010,
	"id"=> 10,
	"state_id"=> "Querétaro",
	"name"=> "Landa de Matamoros"
], [
	"inegi_id"=> 22011,
	"id"=> 11,
	"state_id"=> "Querétaro",
	"name"=> "El Marqués"
], [
	"inegi_id"=> 22012,
	"id"=> 12,
	"state_id"=> "Querétaro",
	"name"=> "Pedro Escobedo"
], [
	"inegi_id"=> 22013,
	"id"=> 13,
	"state_id"=> "Querétaro",
	"name"=> "Peñamiller"
], [
	"inegi_id"=> 22014,
	"id"=> 14,
	"state_id"=> "Querétaro",
	"name"=> "Querétaro"
], [
	"inegi_id"=> 22015,
	"id"=> 15,
	"state_id"=> "Querétaro",
	"name"=> "San Joaquín"
], [
	"inegi_id"=> 22016,
	"id"=> 16,
	"state_id"=> "Querétaro",
	"name"=> "San Juan del Río"
], [
	"inegi_id"=> 22017,
	"id"=> 17,
	"state_id"=> "Querétaro",
	"name"=> "Tequisquiapan"
], [
	"inegi_id"=> 22018,
	"id"=> 18,
	"state_id"=> "Querétaro",
	"name"=> "Tolimán"
], [
	"inegi_id"=> 23001,
	"id"=> 1,
	"state_id"=> "Quintana Roo",
	"name"=> "Cozumel"
], [
	"inegi_id"=> 23002,
	"id"=> 2,
	"state_id"=> "Quintana Roo",
	"name"=> "Felipe Carrillo Puerto"
], [
	"inegi_id"=> 23003,
	"id"=> 3,
	"state_id"=> "Quintana Roo",
	"name"=> "Isla Mujeres"
], [
	"inegi_id"=> 23004,
	"id"=> 4,
	"state_id"=> "Quintana Roo",
	"name"=> "Othón P. Blanco"
], [
	"inegi_id"=> 23005,
	"id"=> 5,
	"state_id"=> "Quintana Roo",
	"name"=> "Benito Juárez"
], [
	"inegi_id"=> 23006,
	"id"=> 6,
	"state_id"=> "Quintana Roo",
	"name"=> "José María Morelos"
], [
	"inegi_id"=> 23007,
	"id"=> 7,
	"state_id"=> "Quintana Roo",
	"name"=> "Lázaro Cárdenas"
], [
	"inegi_id"=> 23008,
	"id"=> 8,
	"state_id"=> "Quintana Roo",
	"name"=> "Solidaridad"
], [
	"inegi_id"=> 23009,
	"id"=> 9,
	"state_id"=> "Quintana Roo",
	"name"=> "Tulum"
], [
	"inegi_id"=> 24001,
	"id"=> 1,
	"state_id"=> "San Luis Potosí",
	"name"=> "Ahualulco"
], [
	"inegi_id"=> 24002,
	"id"=> 2,
	"state_id"=> "San Luis Potosí",
	"name"=> "Alaquines"
], [
	"inegi_id"=> 24003,
	"id"=> 3,
	"state_id"=> "San Luis Potosí",
	"name"=> "Aquismón"
], [
	"inegi_id"=> 24004,
	"id"=> 4,
	"state_id"=> "San Luis Potosí",
	"name"=> "Armadillo de los Infante"
], [
	"inegi_id"=> 24005,
	"id"=> 5,
	"state_id"=> "San Luis Potosí",
	"name"=> "Cárdenas"
], [
	"inegi_id"=> 24006,
	"id"=> 6,
	"state_id"=> "San Luis Potosí",
	"name"=> "Catorce"
], [
	"inegi_id"=> 24007,
	"id"=> 7,
	"state_id"=> "San Luis Potosí",
	"name"=> "Cedral"
], [
	"inegi_id"=> 24008,
	"id"=> 8,
	"state_id"=> "San Luis Potosí",
	"name"=> "Cerritos"
], [
	"inegi_id"=> 24009,
	"id"=> 9,
	"state_id"=> "San Luis Potosí",
	"name"=> "Cerro de San Pedro"
], [
	"inegi_id"=> 24010,
	"id"=> 10,
	"state_id"=> "San Luis Potosí",
	"name"=> "Ciudad del Maíz"
], [
	"inegi_id"=> 24011,
	"id"=> 11,
	"state_id"=> "San Luis Potosí",
	"name"=> "Ciudad Fernández"
], [
	"inegi_id"=> 24012,
	"id"=> 12,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tancanhuitz"
], [
	"inegi_id"=> 24013,
	"id"=> 13,
	"state_id"=> "San Luis Potosí",
	"name"=> "Ciudad Valles"
], [
	"inegi_id"=> 24014,
	"id"=> 14,
	"state_id"=> "San Luis Potosí",
	"name"=> "Coxcatlán"
], [
	"inegi_id"=> 24015,
	"id"=> 15,
	"state_id"=> "San Luis Potosí",
	"name"=> "Charcas"
], [
	"inegi_id"=> 24016,
	"id"=> 16,
	"state_id"=> "San Luis Potosí",
	"name"=> "Ebano"
], [
	"inegi_id"=> 24017,
	"id"=> 17,
	"state_id"=> "San Luis Potosí",
	"name"=> "Guadalcázar"
], [
	"inegi_id"=> 24018,
	"id"=> 18,
	"state_id"=> "San Luis Potosí",
	"name"=> "Huehuetlán"
], [
	"inegi_id"=> 24019,
	"id"=> 19,
	"state_id"=> "San Luis Potosí",
	"name"=> "Lagunillas"
], [
	"inegi_id"=> 24020,
	"id"=> 20,
	"state_id"=> "San Luis Potosí",
	"name"=> "Matehuala"
], [
	"inegi_id"=> 24021,
	"id"=> 21,
	"state_id"=> "San Luis Potosí",
	"name"=> "Mexquitic de Carmona"
], [
	"inegi_id"=> 24022,
	"id"=> 22,
	"state_id"=> "San Luis Potosí",
	"name"=> "Moctezuma"
], [
	"inegi_id"=> 24023,
	"id"=> 23,
	"state_id"=> "San Luis Potosí",
	"name"=> "Rayón"
], [
	"inegi_id"=> 24024,
	"id"=> 24,
	"state_id"=> "San Luis Potosí",
	"name"=> "Rioverde"
], [
	"inegi_id"=> 24025,
	"id"=> 25,
	"state_id"=> "San Luis Potosí",
	"name"=> "Salinas"
], [
	"inegi_id"=> 24026,
	"id"=> 26,
	"state_id"=> "San Luis Potosí",
	"name"=> "San Antonio"
], [
	"inegi_id"=> 24027,
	"id"=> 27,
	"state_id"=> "San Luis Potosí",
	"name"=> "San Ciro de Acosta"
], [
	"inegi_id"=> 24028,
	"id"=> 28,
	"state_id"=> "San Luis Potosí",
	"name"=> "San Luis Potosí"
], [
	"inegi_id"=> 24029,
	"id"=> 29,
	"state_id"=> "San Luis Potosí",
	"name"=> "San Martín Chalchicuautla"
], [
	"inegi_id"=> 24030,
	"id"=> 30,
	"state_id"=> "San Luis Potosí",
	"name"=> "San Nicolás Tolentino"
], [
	"inegi_id"=> 24031,
	"id"=> 31,
	"state_id"=> "San Luis Potosí",
	"name"=> "Santa Catarina"
], [
	"inegi_id"=> 24032,
	"id"=> 32,
	"state_id"=> "San Luis Potosí",
	"name"=> "Santa María del Río"
], [
	"inegi_id"=> 24033,
	"id"=> 33,
	"state_id"=> "San Luis Potosí",
	"name"=> "Santo Domingo"
], [
	"inegi_id"=> 24034,
	"id"=> 34,
	"state_id"=> "San Luis Potosí",
	"name"=> "San Vicente Tancuayalab"
], [
	"inegi_id"=> 24035,
	"id"=> 35,
	"state_id"=> "San Luis Potosí",
	"name"=> "Soledad de Graciano Sánchez"
], [
	"inegi_id"=> 24036,
	"id"=> 36,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tamasopo"
], [
	"inegi_id"=> 24037,
	"id"=> 37,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tamazunchale"
], [
	"inegi_id"=> 24038,
	"id"=> 38,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tampacán"
], [
	"inegi_id"=> 24039,
	"id"=> 39,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tampamolón Corona"
], [
	"inegi_id"=> 24040,
	"id"=> 40,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tamuín"
], [
	"inegi_id"=> 24041,
	"id"=> 41,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tanlajás"
], [
	"inegi_id"=> 24042,
	"id"=> 42,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tanquián de Escobedo"
], [
	"inegi_id"=> 24043,
	"id"=> 43,
	"state_id"=> "San Luis Potosí",
	"name"=> "Tierra Nueva"
], [
	"inegi_id"=> 24044,
	"id"=> 44,
	"state_id"=> "San Luis Potosí",
	"name"=> "Vanegas"
], [
	"inegi_id"=> 24045,
	"id"=> 45,
	"state_id"=> "San Luis Potosí",
	"name"=> "Venado"
], [
	"inegi_id"=> 24046,
	"id"=> 46,
	"state_id"=> "San Luis Potosí",
	"name"=> "Villa de Arriaga"
], [
	"inegi_id"=> 24047,
	"id"=> 47,
	"state_id"=> "San Luis Potosí",
	"name"=> "Villa de Guadalupe"
], [
	"inegi_id"=> 24048,
	"id"=> 48,
	"state_id"=> "San Luis Potosí",
	"name"=> "Villa de la Paz"
], [
	"inegi_id"=> 24049,
	"id"=> 49,
	"state_id"=> "San Luis Potosí",
	"name"=> "Villa de Ramos"
], [
	"inegi_id"=> 24050,
	"id"=> 50,
	"state_id"=> "San Luis Potosí",
	"name"=> "Villa de Reyes"
], [
	"inegi_id"=> 24051,
	"id"=> 51,
	"state_id"=> "San Luis Potosí",
	"name"=> "Villa Hidalgo"
], [
	"inegi_id"=> 24052,
	"id"=> 52,
	"state_id"=> "San Luis Potosí",
	"name"=> "Villa Juárez"
], [
	"inegi_id"=> 24053,
	"id"=> 53,
	"state_id"=> "San Luis Potosí",
	"name"=> "Axtla de Terrazas"
], [
	"inegi_id"=> 24054,
	"id"=> 54,
	"state_id"=> "San Luis Potosí",
	"name"=> "Xilitla"
], [
	"inegi_id"=> 24055,
	"id"=> 55,
	"state_id"=> "San Luis Potosí",
	"name"=> "Zaragoza"
], [
	"inegi_id"=> 24056,
	"id"=> 56,
	"state_id"=> "San Luis Potosí",
	"name"=> "Villa de Arista"
], [
	"inegi_id"=> 24057,
	"id"=> 57,
	"state_id"=> "San Luis Potosí",
	"name"=> "Matlapa"
], [
	"inegi_id"=> 24058,
	"id"=> 58,
	"state_id"=> "San Luis Potosí",
	"name"=> "El Naranjo"
], [
	"inegi_id"=> 25001,
	"id"=> 1,
	"state_id"=> "Sinaloa",
	"name"=> "Ahome"
], [
	"inegi_id"=> 25002,
	"id"=> 2,
	"state_id"=> "Sinaloa",
	"name"=> "Angostura"
], [
	"inegi_id"=> 25003,
	"id"=> 3,
	"state_id"=> "Sinaloa",
	"name"=> "Badiraguato"
], [
	"inegi_id"=> 25004,
	"id"=> 4,
	"state_id"=> "Sinaloa",
	"name"=> "Concordia"
], [
	"inegi_id"=> 25005,
	"id"=> 5,
	"state_id"=> "Sinaloa",
	"name"=> "Cosalá"
], [
	"inegi_id"=> 25006,
	"id"=> 6,
	"state_id"=> "Sinaloa",
	"name"=> "Culiacán"
], [
	"inegi_id"=> 25007,
	"id"=> 7,
	"state_id"=> "Sinaloa",
	"name"=> "Choix"
], [
	"inegi_id"=> 25008,
	"id"=> 8,
	"state_id"=> "Sinaloa",
	"name"=> "Elota"
], [
	"inegi_id"=> 25009,
	"id"=> 9,
	"state_id"=> "Sinaloa",
	"name"=> "Escuinapa"
], [
	"inegi_id"=> 25010,
	"id"=> 10,
	"state_id"=> "Sinaloa",
	"name"=> "El Fuerte"
], [
	"inegi_id"=> 25011,
	"id"=> 11,
	"state_id"=> "Sinaloa",
	"name"=> "Guasave"
], [
	"inegi_id"=> 25012,
	"id"=> 12,
	"state_id"=> "Sinaloa",
	"name"=> "Mazatlán"
], [
	"inegi_id"=> 25013,
	"id"=> 13,
	"state_id"=> "Sinaloa",
	"name"=> "Mocorito"
], [
	"inegi_id"=> 25014,
	"id"=> 14,
	"state_id"=> "Sinaloa",
	"name"=> "Rosario"
], [
	"inegi_id"=> 25015,
	"id"=> 15,
	"state_id"=> "Sinaloa",
	"name"=> "Salvador Alvarado"
], [
	"inegi_id"=> 25016,
	"id"=> 16,
	"state_id"=> "Sinaloa",
	"name"=> "San Ignacio"
], [
	"inegi_id"=> 25017,
	"id"=> 17,
	"state_id"=> "Sinaloa",
	"name"=> "Sinaloa"
], [
	"inegi_id"=> 25018,
	"id"=> 18,
	"state_id"=> "Sinaloa",
	"name"=> "Navolato"
], [
	"inegi_id"=> 26001,
	"id"=> 1,
	"state_id"=> "Sonora",
	"name"=> "Aconchi"
], [
	"inegi_id"=> 26002,
	"id"=> 2,
	"state_id"=> "Sonora",
	"name"=> "Agua Prieta"
], [
	"inegi_id"=> 26003,
	"id"=> 3,
	"state_id"=> "Sonora",
	"name"=> "Alamos"
], [
	"inegi_id"=> 26004,
	"id"=> 4,
	"state_id"=> "Sonora",
	"name"=> "Altar"
], [
	"inegi_id"=> 26005,
	"id"=> 5,
	"state_id"=> "Sonora",
	"name"=> "Arivechi"
], [
	"inegi_id"=> 26006,
	"id"=> 6,
	"state_id"=> "Sonora",
	"name"=> "Arizpe"
], [
	"inegi_id"=> 26007,
	"id"=> 7,
	"state_id"=> "Sonora",
	"name"=> "Atil"
], [
	"inegi_id"=> 26008,
	"id"=> 8,
	"state_id"=> "Sonora",
	"name"=> "Bacadéhuachi"
], [
	"inegi_id"=> 26009,
	"id"=> 9,
	"state_id"=> "Sonora",
	"name"=> "Bacanora"
], [
	"inegi_id"=> 26010,
	"id"=> 10,
	"state_id"=> "Sonora",
	"name"=> "Bacerac"
], [
	"inegi_id"=> 26011,
	"id"=> 11,
	"state_id"=> "Sonora",
	"name"=> "Bacoachi"
], [
	"inegi_id"=> 26012,
	"id"=> 12,
	"state_id"=> "Sonora",
	"name"=> "Bácum"
], [
	"inegi_id"=> 26013,
	"id"=> 13,
	"state_id"=> "Sonora",
	"name"=> "Banámichi"
], [
	"inegi_id"=> 26014,
	"id"=> 14,
	"state_id"=> "Sonora",
	"name"=> "Baviácora"
], [
	"inegi_id"=> 26015,
	"id"=> 15,
	"state_id"=> "Sonora",
	"name"=> "Bavispe"
], [
	"inegi_id"=> 26016,
	"id"=> 16,
	"state_id"=> "Sonora",
	"name"=> "Benjamín Hill"
], [
	"inegi_id"=> 26017,
	"id"=> 17,
	"state_id"=> "Sonora",
	"name"=> "Caborca"
], [
	"inegi_id"=> 26018,
	"id"=> 18,
	"state_id"=> "Sonora",
	"name"=> "Cajeme"
], [
	"inegi_id"=> 26019,
	"id"=> 19,
	"state_id"=> "Sonora",
	"name"=> "Cananea"
], [
	"inegi_id"=> 26020,
	"id"=> 20,
	"state_id"=> "Sonora",
	"name"=> "Carbó"
], [
	"inegi_id"=> 26021,
	"id"=> 21,
	"state_id"=> "Sonora",
	"name"=> "La Colorada"
], [
	"inegi_id"=> 26022,
	"id"=> 22,
	"state_id"=> "Sonora",
	"name"=> "Cucurpe"
], [
	"inegi_id"=> 26023,
	"id"=> 23,
	"state_id"=> "Sonora",
	"name"=> "Cumpas"
], [
	"inegi_id"=> 26024,
	"id"=> 24,
	"state_id"=> "Sonora",
	"name"=> "Divisaderos"
], [
	"inegi_id"=> 26025,
	"id"=> 25,
	"state_id"=> "Sonora",
	"name"=> "Empalme"
], [
	"inegi_id"=> 26026,
	"id"=> 26,
	"state_id"=> "Sonora",
	"name"=> "Etchojoa"
], [
	"inegi_id"=> 26027,
	"id"=> 27,
	"state_id"=> "Sonora",
	"name"=> "Fronteras"
], [
	"inegi_id"=> 26028,
	"id"=> 28,
	"state_id"=> "Sonora",
	"name"=> "Granados"
], [
	"inegi_id"=> 26029,
	"id"=> 29,
	"state_id"=> "Sonora",
	"name"=> "Guaymas"
], [
	"inegi_id"=> 26030,
	"id"=> 30,
	"state_id"=> "Sonora",
	"name"=> "Hermosillo"
], [
	"inegi_id"=> 26031,
	"id"=> 31,
	"state_id"=> "Sonora",
	"name"=> "Huachinera"
], [
	"inegi_id"=> 26032,
	"id"=> 32,
	"state_id"=> "Sonora",
	"name"=> "Huásabas"
], [
	"inegi_id"=> 26033,
	"id"=> 33,
	"state_id"=> "Sonora",
	"name"=> "Huatabampo"
], [
	"inegi_id"=> 26034,
	"id"=> 34,
	"state_id"=> "Sonora",
	"name"=> "Huépac"
], [
	"inegi_id"=> 26035,
	"id"=> 35,
	"state_id"=> "Sonora",
	"name"=> "Imuris"
], [
	"inegi_id"=> 26036,
	"id"=> 36,
	"state_id"=> "Sonora",
	"name"=> "Magdalena"
], [
	"inegi_id"=> 26037,
	"id"=> 37,
	"state_id"=> "Sonora",
	"name"=> "Mazatán"
], [
	"inegi_id"=> 26038,
	"id"=> 38,
	"state_id"=> "Sonora",
	"name"=> "Moctezuma"
], [
	"inegi_id"=> 26039,
	"id"=> 39,
	"state_id"=> "Sonora",
	"name"=> "Naco"
], [
	"inegi_id"=> 26040,
	"id"=> 40,
	"state_id"=> "Sonora",
	"name"=> "Nácori Chico"
], [
	"inegi_id"=> 26041,
	"id"=> 41,
	"state_id"=> "Sonora",
	"name"=> "Nacozari de García"
], [
	"inegi_id"=> 26042,
	"id"=> 42,
	"state_id"=> "Sonora",
	"name"=> "Navojoa"
], [
	"inegi_id"=> 26043,
	"id"=> 43,
	"state_id"=> "Sonora",
	"name"=> "Nogales"
], [
	"inegi_id"=> 26044,
	"id"=> 44,
	"state_id"=> "Sonora",
	"name"=> "Onavas"
], [
	"inegi_id"=> 26045,
	"id"=> 45,
	"state_id"=> "Sonora",
	"name"=> "Opodepe"
], [
	"inegi_id"=> 26046,
	"id"=> 46,
	"state_id"=> "Sonora",
	"name"=> "Oquitoa"
], [
	"inegi_id"=> 26047,
	"id"=> 47,
	"state_id"=> "Sonora",
	"name"=> "Pitiquito"
], [
	"inegi_id"=> 26048,
	"id"=> 48,
	"state_id"=> "Sonora",
	"name"=> "Puerto Peñasco"
], [
	"inegi_id"=> 26049,
	"id"=> 49,
	"state_id"=> "Sonora",
	"name"=> "Quiriego"
], [
	"inegi_id"=> 26050,
	"id"=> 50,
	"state_id"=> "Sonora",
	"name"=> "Rayón"
], [
	"inegi_id"=> 26051,
	"id"=> 51,
	"state_id"=> "Sonora",
	"name"=> "Rosario"
], [
	"inegi_id"=> 26052,
	"id"=> 52,
	"state_id"=> "Sonora",
	"name"=> "Sahuaripa"
], [
	"inegi_id"=> 26053,
	"id"=> 53,
	"state_id"=> "Sonora",
	"name"=> "San Felipe de Jesús"
], [
	"inegi_id"=> 26054,
	"id"=> 54,
	"state_id"=> "Sonora",
	"name"=> "San Javier"
], [
	"inegi_id"=> 26055,
	"id"=> 55,
	"state_id"=> "Sonora",
	"name"=> "San Luis Río Colorado"
], [
	"inegi_id"=> 26056,
	"id"=> 56,
	"state_id"=> "Sonora",
	"name"=> "San Miguel de Horcasitas"
], [
	"inegi_id"=> 26057,
	"id"=> 57,
	"state_id"=> "Sonora",
	"name"=> "San Pedro de la Cueva"
], [
	"inegi_id"=> 26058,
	"id"=> 58,
	"state_id"=> "Sonora",
	"name"=> "Santa Ana"
], [
	"inegi_id"=> 26059,
	"id"=> 59,
	"state_id"=> "Sonora",
	"name"=> "Santa Cruz"
], [
	"inegi_id"=> 26060,
	"id"=> 60,
	"state_id"=> "Sonora",
	"name"=> "Sáric"
], [
	"inegi_id"=> 26061,
	"id"=> 61,
	"state_id"=> "Sonora",
	"name"=> "Soyopa"
], [
	"inegi_id"=> 26062,
	"id"=> 62,
	"state_id"=> "Sonora",
	"name"=> "Suaqui Grande"
], [
	"inegi_id"=> 26063,
	"id"=> 63,
	"state_id"=> "Sonora",
	"name"=> "Tepache"
], [
	"inegi_id"=> 26064,
	"id"=> 64,
	"state_id"=> "Sonora",
	"name"=> "Trincheras"
], [
	"inegi_id"=> 26065,
	"id"=> 65,
	"state_id"=> "Sonora",
	"name"=> "Tubutama"
], [
	"inegi_id"=> 26066,
	"id"=> 66,
	"state_id"=> "Sonora",
	"name"=> "Ures"
], [
	"inegi_id"=> 26067,
	"id"=> 67,
	"state_id"=> "Sonora",
	"name"=> "Villa Hidalgo"
], [
	"inegi_id"=> 26068,
	"id"=> 68,
	"state_id"=> "Sonora",
	"name"=> "Villa Pesqueira"
], [
	"inegi_id"=> 26069,
	"id"=> 69,
	"state_id"=> "Sonora",
	"name"=> "Yécora"
], [
	"inegi_id"=> 26070,
	"id"=> 70,
	"state_id"=> "Sonora",
	"name"=> "General Plutarco Elías Calles"
], [
	"inegi_id"=> 26071,
	"id"=> 71,
	"state_id"=> "Sonora",
	"name"=> "Benito Juárez"
], [
	"inegi_id"=> 26072,
	"id"=> 72,
	"state_id"=> "Sonora",
	"name"=> "San Ignacio Río Muerto"
], [
	"inegi_id"=> 27001,
	"id"=> 1,
	"state_id"=> "Tabasco",
	"name"=> "Balancán"
], [
	"inegi_id"=> 27002,
	"id"=> 2,
	"state_id"=> "Tabasco",
	"name"=> "Cárdenas"
], [
	"inegi_id"=> 27003,
	"id"=> 3,
	"state_id"=> "Tabasco",
	"name"=> "Centla"
], [
	"inegi_id"=> 27004,
	"id"=> 4,
	"state_id"=> "Tabasco",
	"name"=> "Centro"
], [
	"inegi_id"=> 27005,
	"id"=> 5,
	"state_id"=> "Tabasco",
	"name"=> "Comalcalco"
], [
	"inegi_id"=> 27006,
	"id"=> 6,
	"state_id"=> "Tabasco",
	"name"=> "Cunduacán"
], [
	"inegi_id"=> 27007,
	"id"=> 7,
	"state_id"=> "Tabasco",
	"name"=> "Emiliano Zapata"
], [
	"inegi_id"=> 27008,
	"id"=> 8,
	"state_id"=> "Tabasco",
	"name"=> "Huimanguillo"
], [
	"inegi_id"=> 27009,
	"id"=> 9,
	"state_id"=> "Tabasco",
	"name"=> "Jalapa"
], [
	"inegi_id"=> 27010,
	"id"=> 10,
	"state_id"=> "Tabasco",
	"name"=> "Jalpa de Méndez"
], [
	"inegi_id"=> 27011,
	"id"=> 11,
	"state_id"=> "Tabasco",
	"name"=> "Jonuta"
], [
	"inegi_id"=> 27012,
	"id"=> 12,
	"state_id"=> "Tabasco",
	"name"=> "Macuspana"
], [
	"inegi_id"=> 27013,
	"id"=> 13,
	"state_id"=> "Tabasco",
	"name"=> "Nacajuca"
], [
	"inegi_id"=> 27014,
	"id"=> 14,
	"state_id"=> "Tabasco",
	"name"=> "Paraíso"
], [
	"inegi_id"=> 27015,
	"id"=> 15,
	"state_id"=> "Tabasco",
	"name"=> "Tacotalpa"
], [
	"inegi_id"=> 27016,
	"id"=> 16,
	"state_id"=> "Tabasco",
	"name"=> "Teapa"
], [
	"inegi_id"=> 27017,
	"id"=> 17,
	"state_id"=> "Tabasco",
	"name"=> "Tenosique"
], [
	"inegi_id"=> 28001,
	"id"=> 1,
	"state_id"=> "Tamaulipas",
	"name"=> "Abasolo"
], [
	"inegi_id"=> 28002,
	"id"=> 2,
	"state_id"=> "Tamaulipas",
	"name"=> "Aldama"
], [
	"inegi_id"=> 28003,
	"id"=> 3,
	"state_id"=> "Tamaulipas",
	"name"=> "Altamira"
], [
	"inegi_id"=> 28004,
	"id"=> 4,
	"state_id"=> "Tamaulipas",
	"name"=> "Antiguo Morelos"
], [
	"inegi_id"=> 28005,
	"id"=> 5,
	"state_id"=> "Tamaulipas",
	"name"=> "Burgos"
], [
	"inegi_id"=> 28006,
	"id"=> 6,
	"state_id"=> "Tamaulipas",
	"name"=> "Bustamante"
], [
	"inegi_id"=> 28007,
	"id"=> 7,
	"state_id"=> "Tamaulipas",
	"name"=> "Camargo"
], [
	"inegi_id"=> 28008,
	"id"=> 8,
	"state_id"=> "Tamaulipas",
	"name"=> "Casas"
], [
	"inegi_id"=> 28009,
	"id"=> 9,
	"state_id"=> "Tamaulipas",
	"name"=> "Ciudad Madero"
], [
	"inegi_id"=> 28010,
	"id"=> 10,
	"state_id"=> "Tamaulipas",
	"name"=> "Cruillas"
], [
	"inegi_id"=> 28011,
	"id"=> 11,
	"state_id"=> "Tamaulipas",
	"name"=> "Gómez Farías"
], [
	"inegi_id"=> 28012,
	"id"=> 12,
	"state_id"=> "Tamaulipas",
	"name"=> "González"
], [
	"inegi_id"=> 28013,
	"id"=> 13,
	"state_id"=> "Tamaulipas",
	"name"=> "Güémez"
], [
	"inegi_id"=> 28014,
	"id"=> 14,
	"state_id"=> "Tamaulipas",
	"name"=> "Guerrero"
], [
	"inegi_id"=> 28015,
	"id"=> 15,
	"state_id"=> "Tamaulipas",
	"name"=> "Gustavo Díaz Ordaz"
], [
	"inegi_id"=> 28016,
	"id"=> 16,
	"state_id"=> "Tamaulipas",
	"name"=> "Hidalgo"
], [
	"inegi_id"=> 28017,
	"id"=> 17,
	"state_id"=> "Tamaulipas",
	"name"=> "Jaumave"
], [
	"inegi_id"=> 28018,
	"id"=> 18,
	"state_id"=> "Tamaulipas",
	"name"=> "Jiménez"
], [
	"inegi_id"=> 28019,
	"id"=> 19,
	"state_id"=> "Tamaulipas",
	"name"=> "Llera"
], [
	"inegi_id"=> 28020,
	"id"=> 20,
	"state_id"=> "Tamaulipas",
	"name"=> "Mainero"
], [
	"inegi_id"=> 28021,
	"id"=> 21,
	"state_id"=> "Tamaulipas",
	"name"=> "El Mante"
], [
	"inegi_id"=> 28022,
	"id"=> 22,
	"state_id"=> "Tamaulipas",
	"name"=> "Matamoros"
], [
	"inegi_id"=> 28023,
	"id"=> 23,
	"state_id"=> "Tamaulipas",
	"name"=> "Méndez"
], [
	"inegi_id"=> 28024,
	"id"=> 24,
	"state_id"=> "Tamaulipas",
	"name"=> "Mier"
], [
	"inegi_id"=> 28025,
	"id"=> 25,
	"state_id"=> "Tamaulipas",
	"name"=> "Miguel Alemán"
], [
	"inegi_id"=> 28026,
	"id"=> 26,
	"state_id"=> "Tamaulipas",
	"name"=> "Miquihuana"
], [
	"inegi_id"=> 28027,
	"id"=> 27,
	"state_id"=> "Tamaulipas",
	"name"=> "Nuevo Laredo"
], [
	"inegi_id"=> 28028,
	"id"=> 28,
	"state_id"=> "Tamaulipas",
	"name"=> "Nuevo Morelos"
], [
	"inegi_id"=> 28029,
	"id"=> 29,
	"state_id"=> "Tamaulipas",
	"name"=> "Ocampo"
], [
	"inegi_id"=> 28030,
	"id"=> 30,
	"state_id"=> "Tamaulipas",
	"name"=> "Padilla"
], [
	"inegi_id"=> 28031,
	"id"=> 31,
	"state_id"=> "Tamaulipas",
	"name"=> "Palmillas"
], [
	"inegi_id"=> 28032,
	"id"=> 32,
	"state_id"=> "Tamaulipas",
	"name"=> "Reynosa"
], [
	"inegi_id"=> 28033,
	"id"=> 33,
	"state_id"=> "Tamaulipas",
	"name"=> "Río Bravo"
], [
	"inegi_id"=> 28034,
	"id"=> 34,
	"state_id"=> "Tamaulipas",
	"name"=> "San Carlos"
], [
	"inegi_id"=> 28035,
	"id"=> 35,
	"state_id"=> "Tamaulipas",
	"name"=> "San Fernando"
], [
	"inegi_id"=> 28036,
	"id"=> 36,
	"state_id"=> "Tamaulipas",
	"name"=> "San Nicolás"
], [
	"inegi_id"=> 28037,
	"id"=> 37,
	"state_id"=> "Tamaulipas",
	"name"=> "Soto la Marina"
], [
	"inegi_id"=> 28038,
	"id"=> 38,
	"state_id"=> "Tamaulipas",
	"name"=> "Tampico"
], [
	"inegi_id"=> 28039,
	"id"=> 39,
	"state_id"=> "Tamaulipas",
	"name"=> "Tula"
], [
	"inegi_id"=> 28040,
	"id"=> 40,
	"state_id"=> "Tamaulipas",
	"name"=> "Valle Hermoso"
], [
	"inegi_id"=> 28041,
	"id"=> 41,
	"state_id"=> "Tamaulipas",
	"name"=> "Victoria"
], [
	"inegi_id"=> 28042,
	"id"=> 42,
	"state_id"=> "Tamaulipas",
	"name"=> "Villagrán"
], [
	"inegi_id"=> 28043,
	"id"=> 43,
	"state_id"=> "Tamaulipas",
	"name"=> "Xicoténcatl"
], [
	"inegi_id"=> 29001,
	"id"=> 1,
	"state_id"=> "Tlaxcala",
	"name"=> "Amaxac de Guerrero"
], [
	"inegi_id"=> 29002,
	"id"=> 2,
	"state_id"=> "Tlaxcala",
	"name"=> "Apetatitlán de Antonio Carvajal"
], [
	"inegi_id"=> 29003,
	"id"=> 3,
	"state_id"=> "Tlaxcala",
	"name"=> "Atlangatepec"
], [
	"inegi_id"=> 29004,
	"id"=> 4,
	"state_id"=> "Tlaxcala",
	"name"=> "Altzayanca"
], [
	"inegi_id"=> 29005,
	"id"=> 5,
	"state_id"=> "Tlaxcala",
	"name"=> "Apizaco"
], [
	"inegi_id"=> 29006,
	"id"=> 6,
	"state_id"=> "Tlaxcala",
	"name"=> "Calpulalpan"
], [
	"inegi_id"=> 29007,
	"id"=> 7,
	"state_id"=> "Tlaxcala",
	"name"=> "El Carmen Tequexquitla"
], [
	"inegi_id"=> 29008,
	"id"=> 8,
	"state_id"=> "Tlaxcala",
	"name"=> "Cuapiaxtla"
], [
	"inegi_id"=> 29009,
	"id"=> 9,
	"state_id"=> "Tlaxcala",
	"name"=> "Cuaxomulco"
], [
	"inegi_id"=> 29010,
	"id"=> 10,
	"state_id"=> "Tlaxcala",
	"name"=> "Chiautempan"
], [
	"inegi_id"=> 29011,
	"id"=> 11,
	"state_id"=> "Tlaxcala",
	"name"=> "Muñoz de Domingo Arenas"
], [
	"inegi_id"=> 29012,
	"id"=> 12,
	"state_id"=> "Tlaxcala",
	"name"=> "Españita"
], [
	"inegi_id"=> 29013,
	"id"=> 13,
	"state_id"=> "Tlaxcala",
	"name"=> "Huamantla"
], [
	"inegi_id"=> 29014,
	"id"=> 14,
	"state_id"=> "Tlaxcala",
	"name"=> "Hueyotlipan"
], [
	"inegi_id"=> 29015,
	"id"=> 15,
	"state_id"=> "Tlaxcala",
	"name"=> "Ixtacuixtla de Mariano Matamoros"
], [
	"inegi_id"=> 29016,
	"id"=> 16,
	"state_id"=> "Tlaxcala",
	"name"=> "Ixtenco"
], [
	"inegi_id"=> 29017,
	"id"=> 17,
	"state_id"=> "Tlaxcala",
	"name"=> "Mazatecochco de José María Morelos"
], [
	"inegi_id"=> 29018,
	"id"=> 18,
	"state_id"=> "Tlaxcala",
	"name"=> "Contla de Juan Cuamatzi"
], [
	"inegi_id"=> 29019,
	"id"=> 19,
	"state_id"=> "Tlaxcala",
	"name"=> "Tepetitla de Lardizábal"
], [
	"inegi_id"=> 29020,
	"id"=> 20,
	"state_id"=> "Tlaxcala",
	"name"=> "Sanctórum de Lázaro Cárdenas"
], [
	"inegi_id"=> 29021,
	"id"=> 21,
	"state_id"=> "Tlaxcala",
	"name"=> "Nanacamilpa de Mariano Arista"
], [
	"inegi_id"=> 29022,
	"id"=> 22,
	"state_id"=> "Tlaxcala",
	"name"=> "Acuamanala de Miguel Hidalgo"
], [
	"inegi_id"=> 29023,
	"id"=> 23,
	"state_id"=> "Tlaxcala",
	"name"=> "Natívitas"
], [
	"inegi_id"=> 29024,
	"id"=> 24,
	"state_id"=> "Tlaxcala",
	"name"=> "Panotla"
], [
	"inegi_id"=> 29025,
	"id"=> 25,
	"state_id"=> "Tlaxcala",
	"name"=> "San Pablo del Monte"
], [
	"inegi_id"=> 29026,
	"id"=> 26,
	"state_id"=> "Tlaxcala",
	"name"=> "Santa Cruz Tlaxcala"
], [
	"inegi_id"=> 29027,
	"id"=> 27,
	"state_id"=> "Tlaxcala",
	"name"=> "Tenancingo"
], [
	"inegi_id"=> 29028,
	"id"=> 28,
	"state_id"=> "Tlaxcala",
	"name"=> "Teolocholco"
], [
	"inegi_id"=> 29029,
	"id"=> 29,
	"state_id"=> "Tlaxcala",
	"name"=> "Tepeyanco"
], [
	"inegi_id"=> 29030,
	"id"=> 30,
	"state_id"=> "Tlaxcala",
	"name"=> "Terrenate"
], [
	"inegi_id"=> 29031,
	"id"=> 31,
	"state_id"=> "Tlaxcala",
	"name"=> "Tetla de la Solidaridad"
], [
	"inegi_id"=> 29032,
	"id"=> 32,
	"state_id"=> "Tlaxcala",
	"name"=> "Tetlatlahuca"
], [
	"inegi_id"=> 29033,
	"id"=> 33,
	"state_id"=> "Tlaxcala",
	"name"=> "Tlaxcala"
], [
	"inegi_id"=> 29034,
	"id"=> 34,
	"state_id"=> "Tlaxcala",
	"name"=> "Tlaxco"
], [
	"inegi_id"=> 29035,
	"id"=> 35,
	"state_id"=> "Tlaxcala",
	"name"=> "Tocatlán"
], [
	"inegi_id"=> 29036,
	"id"=> 36,
	"state_id"=> "Tlaxcala",
	"name"=> "Totolac"
], [
	"inegi_id"=> 29037,
	"id"=> 37,
	"state_id"=> "Tlaxcala",
	"name"=> "Zitlaltepec de Trinidad Sánchez Santos"
], [
	"inegi_id"=> 29038,
	"id"=> 38,
	"state_id"=> "Tlaxcala",
	"name"=> "Tzompantepec"
], [
	"inegi_id"=> 29039,
	"id"=> 39,
	"state_id"=> "Tlaxcala",
	"name"=> "Xaloztoc"
], [
	"inegi_id"=> 29040,
	"id"=> 40,
	"state_id"=> "Tlaxcala",
	"name"=> "Xaltocan"
], [
	"inegi_id"=> 29041,
	"id"=> 41,
	"state_id"=> "Tlaxcala",
	"name"=> "Papalotla de Xicohténcatl"
], [
	"inegi_id"=> 29042,
	"id"=> 42,
	"state_id"=> "Tlaxcala",
	"name"=> "Xicohtzinco"
], [
	"inegi_id"=> 29043,
	"id"=> 43,
	"state_id"=> "Tlaxcala",
	"name"=> "Yauhquemecan"
], [
	"inegi_id"=> 29044,
	"id"=> 44,
	"state_id"=> "Tlaxcala",
	"name"=> "Zacatelco"
], [
	"inegi_id"=> 29045,
	"id"=> 45,
	"state_id"=> "Tlaxcala",
	"name"=> "Benito Juárez"
], [
	"inegi_id"=> 29046,
	"id"=> 46,
	"state_id"=> "Tlaxcala",
	"name"=> "Emiliano Zapata"
], [
	"inegi_id"=> 29047,
	"id"=> 47,
	"state_id"=> "Tlaxcala",
	"name"=> "Lázaro Cárdenas"
], [
	"inegi_id"=> 29048,
	"id"=> 48,
	"state_id"=> "Tlaxcala",
	"name"=> "La Magdalena Tlaltelulco"
], [
	"inegi_id"=> 29049,
	"id"=> 49,
	"state_id"=> "Tlaxcala",
	"name"=> "San Damián Texoloc"
], [
	"inegi_id"=> 29050,
	"id"=> 50,
	"state_id"=> "Tlaxcala",
	"name"=> "San Francisco Tetlanohcan"
], [
	"inegi_id"=> 29051,
	"id"=> 51,
	"state_id"=> "Tlaxcala",
	"name"=> "San Jerónimo Zacualpan"
], [
	"inegi_id"=> 29052,
	"id"=> 52,
	"state_id"=> "Tlaxcala",
	"name"=> "San José Teacalco"
], [
	"inegi_id"=> 29053,
	"id"=> 53,
	"state_id"=> "Tlaxcala",
	"name"=> "San Juan Huactzinco"
], [
	"inegi_id"=> 29054,
	"id"=> 54,
	"state_id"=> "Tlaxcala",
	"name"=> "San Lorenzo Axocomanitla"
], [
	"inegi_id"=> 29055,
	"id"=> 55,
	"state_id"=> "Tlaxcala",
	"name"=> "San Lucas Tecopilco"
], [
	"inegi_id"=> 29056,
	"id"=> 56,
	"state_id"=> "Tlaxcala",
	"name"=> "Santa Ana Nopalucan"
], [
	"inegi_id"=> 29057,
	"id"=> 57,
	"state_id"=> "Tlaxcala",
	"name"=> "Santa Apolonia Teacalco"
], [
	"inegi_id"=> 29058,
	"id"=> 58,
	"state_id"=> "Tlaxcala",
	"name"=> "Santa Catarina Ayometla"
], [
	"inegi_id"=> 29059,
	"id"=> 59,
	"state_id"=> "Tlaxcala",
	"name"=> "Santa Cruz Quilehtla"
], [
	"inegi_id"=> 29060,
	"id"=> 60,
	"state_id"=> "Tlaxcala",
	"name"=> "Santa Isabel Xiloxoxtla"
], [
	"inegi_id"=> 30001,
	"id"=> 1,
	"state_id"=> "Veracruz",
	"name"=> "Acajete"
], [
	"inegi_id"=> 30002,
	"id"=> 2,
	"state_id"=> "Veracruz",
	"name"=> "Acatlán"
], [
	"inegi_id"=> 30003,
	"id"=> 3,
	"state_id"=> "Veracruz",
	"name"=> "Acayucan"
], [
	"inegi_id"=> 30004,
	"id"=> 4,
	"state_id"=> "Veracruz",
	"name"=> "Actopan"
], [
	"inegi_id"=> 30005,
	"id"=> 5,
	"state_id"=> "Veracruz",
	"name"=> "Acula"
], [
	"inegi_id"=> 30006,
	"id"=> 6,
	"state_id"=> "Veracruz",
	"name"=> "Acultzingo"
], [
	"inegi_id"=> 30007,
	"id"=> 7,
	"state_id"=> "Veracruz",
	"name"=> "Camarón de Tejeda"
], [
	"inegi_id"=> 30008,
	"id"=> 8,
	"state_id"=> "Veracruz",
	"name"=> "Alpatláhuac"
], [
	"inegi_id"=> 30009,
	"id"=> 9,
	"state_id"=> "Veracruz",
	"name"=> "Alto Lucero de Gutiérrez Barrios"
], [
	"inegi_id"=> 30010,
	"id"=> 10,
	"state_id"=> "Veracruz",
	"name"=> "Altotonga"
], [
	"inegi_id"=> 30011,
	"id"=> 11,
	"state_id"=> "Veracruz",
	"name"=> "Alvarado"
], [
	"inegi_id"=> 30012,
	"id"=> 12,
	"state_id"=> "Veracruz",
	"name"=> "Amatitlán"
], [
	"inegi_id"=> 30013,
	"id"=> 13,
	"state_id"=> "Veracruz",
	"name"=> "Naranjos Amatlán"
], [
	"inegi_id"=> 30014,
	"id"=> 14,
	"state_id"=> "Veracruz",
	"name"=> "Amatlán de los Reyes"
], [
	"inegi_id"=> 30015,
	"id"=> 15,
	"state_id"=> "Veracruz",
	"name"=> "Angel R. Cabada"
], [
	"inegi_id"=> 30016,
	"id"=> 16,
	"state_id"=> "Veracruz",
	"name"=> "La Antigua"
], [
	"inegi_id"=> 30017,
	"id"=> 17,
	"state_id"=> "Veracruz",
	"name"=> "Apazapan"
], [
	"inegi_id"=> 30018,
	"id"=> 18,
	"state_id"=> "Veracruz",
	"name"=> "Aquila"
], [
	"inegi_id"=> 30019,
	"id"=> 19,
	"state_id"=> "Veracruz",
	"name"=> "Astacinga"
], [
	"inegi_id"=> 30020,
	"id"=> 20,
	"state_id"=> "Veracruz",
	"name"=> "Atlahuilco"
], [
	"inegi_id"=> 30021,
	"id"=> 21,
	"state_id"=> "Veracruz",
	"name"=> "Atoyac"
], [
	"inegi_id"=> 30022,
	"id"=> 22,
	"state_id"=> "Veracruz",
	"name"=> "Atzacan"
], [
	"inegi_id"=> 30023,
	"id"=> 23,
	"state_id"=> "Veracruz",
	"name"=> "Atzalan"
], [
	"inegi_id"=> 30024,
	"id"=> 24,
	"state_id"=> "Veracruz",
	"name"=> "Tlaltetela"
], [
	"inegi_id"=> 30025,
	"id"=> 25,
	"state_id"=> "Veracruz",
	"name"=> "Ayahualulco"
], [
	"inegi_id"=> 30026,
	"id"=> 26,
	"state_id"=> "Veracruz",
	"name"=> "Banderilla"
], [
	"inegi_id"=> 30027,
	"id"=> 27,
	"state_id"=> "Veracruz",
	"name"=> "Benito Juárez"
], [
	"inegi_id"=> 30028,
	"id"=> 28,
	"state_id"=> "Veracruz",
	"name"=> "Boca del Río"
], [
	"inegi_id"=> 30029,
	"id"=> 29,
	"state_id"=> "Veracruz",
	"name"=> "Calcahualco"
], [
	"inegi_id"=> 30030,
	"id"=> 30,
	"state_id"=> "Veracruz",
	"name"=> "Camerino Z. Mendoza"
], [
	"inegi_id"=> 30031,
	"id"=> 31,
	"state_id"=> "Veracruz",
	"name"=> "Carrillo Puerto"
], [
	"inegi_id"=> 30032,
	"id"=> 32,
	"state_id"=> "Veracruz",
	"name"=> "Catemaco"
], [
	"inegi_id"=> 30033,
	"id"=> 33,
	"state_id"=> "Veracruz",
	"name"=> "Cazones"
], [
	"inegi_id"=> 30034,
	"id"=> 34,
	"state_id"=> "Veracruz",
	"name"=> "Cerro Azul"
], [
	"inegi_id"=> 30035,
	"id"=> 35,
	"state_id"=> "Veracruz",
	"name"=> "Citlaltépetl"
], [
	"inegi_id"=> 30036,
	"id"=> 36,
	"state_id"=> "Veracruz",
	"name"=> "Coacoatzintla"
], [
	"inegi_id"=> 30037,
	"id"=> 37,
	"state_id"=> "Veracruz",
	"name"=> "Coahuitlán"
], [
	"inegi_id"=> 30038,
	"id"=> 38,
	"state_id"=> "Veracruz",
	"name"=> "Coatepec"
], [
	"inegi_id"=> 30039,
	"id"=> 39,
	"state_id"=> "Veracruz",
	"name"=> "Coatzacoalcos"
], [
	"inegi_id"=> 30040,
	"id"=> 40,
	"state_id"=> "Veracruz",
	"name"=> "Coatzintla"
], [
	"inegi_id"=> 30041,
	"id"=> 41,
	"state_id"=> "Veracruz",
	"name"=> "Coetzala"
], [
	"inegi_id"=> 30042,
	"id"=> 42,
	"state_id"=> "Veracruz",
	"name"=> "Colipa"
], [
	"inegi_id"=> 30043,
	"id"=> 43,
	"state_id"=> "Veracruz",
	"name"=> "Comapa"
], [
	"inegi_id"=> 30044,
	"id"=> 44,
	"state_id"=> "Veracruz",
	"name"=> "Córdoba"
], [
	"inegi_id"=> 30045,
	"id"=> 45,
	"state_id"=> "Veracruz",
	"name"=> "Cosamaloapan de Carpio"
], [
	"inegi_id"=> 30046,
	"id"=> 46,
	"state_id"=> "Veracruz",
	"name"=> "Cosautlán de Carvajal"
], [
	"inegi_id"=> 30047,
	"id"=> 47,
	"state_id"=> "Veracruz",
	"name"=> "Coscomatepec"
], [
	"inegi_id"=> 30048,
	"id"=> 48,
	"state_id"=> "Veracruz",
	"name"=> "Cosoleacaque"
], [
	"inegi_id"=> 30049,
	"id"=> 49,
	"state_id"=> "Veracruz",
	"name"=> "Cotaxtla"
], [
	"inegi_id"=> 30050,
	"id"=> 50,
	"state_id"=> "Veracruz",
	"name"=> "Coxquihui"
], [
	"inegi_id"=> 30051,
	"id"=> 51,
	"state_id"=> "Veracruz",
	"name"=> "Coyutla"
], [
	"inegi_id"=> 30052,
	"id"=> 52,
	"state_id"=> "Veracruz",
	"name"=> "Cuichapa"
], [
	"inegi_id"=> 30053,
	"id"=> 53,
	"state_id"=> "Veracruz",
	"name"=> "Cuitláhuac"
], [
	"inegi_id"=> 30054,
	"id"=> 54,
	"state_id"=> "Veracruz",
	"name"=> "Chacaltianguis"
], [
	"inegi_id"=> 30055,
	"id"=> 55,
	"state_id"=> "Veracruz",
	"name"=> "Chalma"
], [
	"inegi_id"=> 30056,
	"id"=> 56,
	"state_id"=> "Veracruz",
	"name"=> "Chiconamel"
], [
	"inegi_id"=> 30057,
	"id"=> 57,
	"state_id"=> "Veracruz",
	"name"=> "Chiconquiaco"
], [
	"inegi_id"=> 30058,
	"id"=> 58,
	"state_id"=> "Veracruz",
	"name"=> "Chicontepec"
], [
	"inegi_id"=> 30059,
	"id"=> 59,
	"state_id"=> "Veracruz",
	"name"=> "Chinameca"
], [
	"inegi_id"=> 30060,
	"id"=> 60,
	"state_id"=> "Veracruz",
	"name"=> "Chinampa de Gorostiza"
], [
	"inegi_id"=> 30061,
	"id"=> 61,
	"state_id"=> "Veracruz",
	"name"=> "Las Choapas"
], [
	"inegi_id"=> 30062,
	"id"=> 62,
	"state_id"=> "Veracruz",
	"name"=> "Chocamán"
], [
	"inegi_id"=> 30063,
	"id"=> 63,
	"state_id"=> "Veracruz",
	"name"=> "Chontla"
], [
	"inegi_id"=> 30064,
	"id"=> 64,
	"state_id"=> "Veracruz",
	"name"=> "Chumatlán"
], [
	"inegi_id"=> 30065,
	"id"=> 65,
	"state_id"=> "Veracruz",
	"name"=> "Emiliano Zapata"
], [
	"inegi_id"=> 30066,
	"id"=> 66,
	"state_id"=> "Veracruz",
	"name"=> "Espinal"
], [
	"inegi_id"=> 30067,
	"id"=> 67,
	"state_id"=> "Veracruz",
	"name"=> "Filomeno Mata"
], [
	"inegi_id"=> 30068,
	"id"=> 68,
	"state_id"=> "Veracruz",
	"name"=> "Fortín"
], [
	"inegi_id"=> 30069,
	"id"=> 69,
	"state_id"=> "Veracruz",
	"name"=> "Gutiérrez Zamora"
], [
	"inegi_id"=> 30070,
	"id"=> 70,
	"state_id"=> "Veracruz",
	"name"=> "Hidalgotitlán"
], [
	"inegi_id"=> 30071,
	"id"=> 71,
	"state_id"=> "Veracruz",
	"name"=> "Huatusco"
], [
	"inegi_id"=> 30072,
	"id"=> 72,
	"state_id"=> "Veracruz",
	"name"=> "Huayacocotla"
], [
	"inegi_id"=> 30073,
	"id"=> 73,
	"state_id"=> "Veracruz",
	"name"=> "Hueyapan de Ocampo"
], [
	"inegi_id"=> 30074,
	"id"=> 74,
	"state_id"=> "Veracruz",
	"name"=> "Huiloapan"
], [
	"inegi_id"=> 30075,
	"id"=> 75,
	"state_id"=> "Veracruz",
	"name"=> "Ignacio de la Llave"
], [
	"inegi_id"=> 30076,
	"id"=> 76,
	"state_id"=> "Veracruz",
	"name"=> "Ilamatlán"
], [
	"inegi_id"=> 30077,
	"id"=> 77,
	"state_id"=> "Veracruz",
	"name"=> "Isla"
], [
	"inegi_id"=> 30078,
	"id"=> 78,
	"state_id"=> "Veracruz",
	"name"=> "Ixcatepec"
], [
	"inegi_id"=> 30079,
	"id"=> 79,
	"state_id"=> "Veracruz",
	"name"=> "Ixhuacán de los Reyes"
], [
	"inegi_id"=> 30080,
	"id"=> 80,
	"state_id"=> "Veracruz",
	"name"=> "Ixhuatlán del Café"
], [
	"inegi_id"=> 30081,
	"id"=> 81,
	"state_id"=> "Veracruz",
	"name"=> "Ixhuatlancillo"
], [
	"inegi_id"=> 30082,
	"id"=> 82,
	"state_id"=> "Veracruz",
	"name"=> "Ixhuatlán del Sureste"
], [
	"inegi_id"=> 30083,
	"id"=> 83,
	"state_id"=> "Veracruz",
	"name"=> "Ixhuatlán de Madero"
], [
	"inegi_id"=> 30084,
	"id"=> 84,
	"state_id"=> "Veracruz",
	"name"=> "Ixmatlahuacan"
], [
	"inegi_id"=> 30085,
	"id"=> 85,
	"state_id"=> "Veracruz",
	"name"=> "Ixtaczoquitlán"
], [
	"inegi_id"=> 30086,
	"id"=> 86,
	"state_id"=> "Veracruz",
	"name"=> "Jalacingo"
], [
	"inegi_id"=> 30087,
	"id"=> 87,
	"state_id"=> "Veracruz",
	"name"=> "Xalapa"
], [
	"inegi_id"=> 30088,
	"id"=> 88,
	"state_id"=> "Veracruz",
	"name"=> "Jalcomulco"
], [
	"inegi_id"=> 30089,
	"id"=> 89,
	"state_id"=> "Veracruz",
	"name"=> "Jáltipan"
], [
	"inegi_id"=> 30090,
	"id"=> 90,
	"state_id"=> "Veracruz",
	"name"=> "Jamapa"
], [
	"inegi_id"=> 30091,
	"id"=> 91,
	"state_id"=> "Veracruz",
	"name"=> "Jesús Carranza"
], [
	"inegi_id"=> 30092,
	"id"=> 92,
	"state_id"=> "Veracruz",
	"name"=> "Xico"
], [
	"inegi_id"=> 30093,
	"id"=> 93,
	"state_id"=> "Veracruz",
	"name"=> "Jilotepec"
], [
	"inegi_id"=> 30094,
	"id"=> 94,
	"state_id"=> "Veracruz",
	"name"=> "Juan Rodríguez Clara"
], [
	"inegi_id"=> 30095,
	"id"=> 95,
	"state_id"=> "Veracruz",
	"name"=> "Juchique de Ferrer"
], [
	"inegi_id"=> 30096,
	"id"=> 96,
	"state_id"=> "Veracruz",
	"name"=> "Landero y Coss"
], [
	"inegi_id"=> 30097,
	"id"=> 97,
	"state_id"=> "Veracruz",
	"name"=> "Lerdo de Tejada"
], [
	"inegi_id"=> 30098,
	"id"=> 98,
	"state_id"=> "Veracruz",
	"name"=> "Magdalena"
], [
	"inegi_id"=> 30099,
	"id"=> 99,
	"state_id"=> "Veracruz",
	"name"=> "Maltrata"
], [
	"inegi_id"=> 30100,
	"id"=> 100,
	"state_id"=> "Veracruz",
	"name"=> "Manlio Fabio Altamirano"
], [
	"inegi_id"=> 30101,
	"id"=> 101,
	"state_id"=> "Veracruz",
	"name"=> "Mariano Escobedo"
], [
	"inegi_id"=> 30102,
	"id"=> 102,
	"state_id"=> "Veracruz",
	"name"=> "Martínez de la Torre"
], [
	"inegi_id"=> 30103,
	"id"=> 103,
	"state_id"=> "Veracruz",
	"name"=> "Mecatlán"
], [
	"inegi_id"=> 30104,
	"id"=> 104,
	"state_id"=> "Veracruz",
	"name"=> "Mecayapan"
], [
	"inegi_id"=> 30105,
	"id"=> 105,
	"state_id"=> "Veracruz",
	"name"=> "Medellín"
], [
	"inegi_id"=> 30106,
	"id"=> 106,
	"state_id"=> "Veracruz",
	"name"=> "Miahuatlán"
], [
	"inegi_id"=> 30107,
	"id"=> 107,
	"state_id"=> "Veracruz",
	"name"=> "Las Minas"
], [
	"inegi_id"=> 30108,
	"id"=> 108,
	"state_id"=> "Veracruz",
	"name"=> "Minatitlán"
], [
	"inegi_id"=> 30109,
	"id"=> 109,
	"state_id"=> "Veracruz",
	"name"=> "Misantla"
], [
	"inegi_id"=> 30110,
	"id"=> 110,
	"state_id"=> "Veracruz",
	"name"=> "Mixtla de Altamirano"
], [
	"inegi_id"=> 30111,
	"id"=> 111,
	"state_id"=> "Veracruz",
	"name"=> "Moloacán"
], [
	"inegi_id"=> 30112,
	"id"=> 112,
	"state_id"=> "Veracruz",
	"name"=> "Naolinco"
], [
	"inegi_id"=> 30113,
	"id"=> 113,
	"state_id"=> "Veracruz",
	"name"=> "Naranjal"
], [
	"inegi_id"=> 30114,
	"id"=> 114,
	"state_id"=> "Veracruz",
	"name"=> "Nautla"
], [
	"inegi_id"=> 30115,
	"id"=> 115,
	"state_id"=> "Veracruz",
	"name"=> "Nogales"
], [
	"inegi_id"=> 30116,
	"id"=> 116,
	"state_id"=> "Veracruz",
	"name"=> "Oluta"
], [
	"inegi_id"=> 30117,
	"id"=> 117,
	"state_id"=> "Veracruz",
	"name"=> "Omealca"
], [
	"inegi_id"=> 30118,
	"id"=> 118,
	"state_id"=> "Veracruz",
	"name"=> "Orizaba"
], [
	"inegi_id"=> 30119,
	"id"=> 119,
	"state_id"=> "Veracruz",
	"name"=> "Otatitlán"
], [
	"inegi_id"=> 30120,
	"id"=> 120,
	"state_id"=> "Veracruz",
	"name"=> "Oteapan"
], [
	"inegi_id"=> 30121,
	"id"=> 121,
	"state_id"=> "Veracruz",
	"name"=> "Ozuluama de Mascareñas"
], [
	"inegi_id"=> 30122,
	"id"=> 122,
	"state_id"=> "Veracruz",
	"name"=> "Pajapan"
], [
	"inegi_id"=> 30123,
	"id"=> 123,
	"state_id"=> "Veracruz",
	"name"=> "Pánuco"
], [
	"inegi_id"=> 30124,
	"id"=> 124,
	"state_id"=> "Veracruz",
	"name"=> "Papantla"
], [
	"inegi_id"=> 30125,
	"id"=> 125,
	"state_id"=> "Veracruz",
	"name"=> "Paso del Macho"
], [
	"inegi_id"=> 30126,
	"id"=> 126,
	"state_id"=> "Veracruz",
	"name"=> "Paso de Ovejas"
], [
	"inegi_id"=> 30127,
	"id"=> 127,
	"state_id"=> "Veracruz",
	"name"=> "La Perla"
], [
	"inegi_id"=> 30128,
	"id"=> 128,
	"state_id"=> "Veracruz",
	"name"=> "Perote"
], [
	"inegi_id"=> 30129,
	"id"=> 129,
	"state_id"=> "Veracruz",
	"name"=> "Platón Sánchez"
], [
	"inegi_id"=> 30130,
	"id"=> 130,
	"state_id"=> "Veracruz",
	"name"=> "Playa Vicente"
], [
	"inegi_id"=> 30131,
	"id"=> 131,
	"state_id"=> "Veracruz",
	"name"=> "Poza Rica de Hidalgo"
], [
	"inegi_id"=> 30132,
	"id"=> 132,
	"state_id"=> "Veracruz",
	"name"=> "Las Vigas de Ramírez"
], [
	"inegi_id"=> 30133,
	"id"=> 133,
	"state_id"=> "Veracruz",
	"name"=> "Pueblo Viejo"
], [
	"inegi_id"=> 30134,
	"id"=> 134,
	"state_id"=> "Veracruz",
	"name"=> "Puente Nacional"
], [
	"inegi_id"=> 30135,
	"id"=> 135,
	"state_id"=> "Veracruz",
	"name"=> "Rafael Delgado"
], [
	"inegi_id"=> 30136,
	"id"=> 136,
	"state_id"=> "Veracruz",
	"name"=> "Rafael Lucio"
], [
	"inegi_id"=> 30137,
	"id"=> 137,
	"state_id"=> "Veracruz",
	"name"=> "Los Reyes"
], [
	"inegi_id"=> 30138,
	"id"=> 138,
	"state_id"=> "Veracruz",
	"name"=> "Río Blanco"
], [
	"inegi_id"=> 30139,
	"id"=> 139,
	"state_id"=> "Veracruz",
	"name"=> "Saltabarranca"
], [
	"inegi_id"=> 30140,
	"id"=> 140,
	"state_id"=> "Veracruz",
	"name"=> "San Andrés Tenejapan"
], [
	"inegi_id"=> 30141,
	"id"=> 141,
	"state_id"=> "Veracruz",
	"name"=> "San Andrés Tuxtla"
], [
	"inegi_id"=> 30142,
	"id"=> 142,
	"state_id"=> "Veracruz",
	"name"=> "San Juan Evangelista"
], [
	"inegi_id"=> 30143,
	"id"=> 143,
	"state_id"=> "Veracruz",
	"name"=> "Santiago Tuxtla"
], [
	"inegi_id"=> 30144,
	"id"=> 144,
	"state_id"=> "Veracruz",
	"name"=> "Sayula de Alemán"
], [
	"inegi_id"=> 30145,
	"id"=> 145,
	"state_id"=> "Veracruz",
	"name"=> "Soconusco"
], [
	"inegi_id"=> 30146,
	"id"=> 146,
	"state_id"=> "Veracruz",
	"name"=> "Sochiapa"
], [
	"inegi_id"=> 30147,
	"id"=> 147,
	"state_id"=> "Veracruz",
	"name"=> "Soledad Atzompa"
], [
	"inegi_id"=> 30148,
	"id"=> 148,
	"state_id"=> "Veracruz",
	"name"=> "Soledad de Doblado"
], [
	"inegi_id"=> 30149,
	"id"=> 149,
	"state_id"=> "Veracruz",
	"name"=> "Soteapan"
], [
	"inegi_id"=> 30150,
	"id"=> 150,
	"state_id"=> "Veracruz",
	"name"=> "Tamalín"
], [
	"inegi_id"=> 30151,
	"id"=> 151,
	"state_id"=> "Veracruz",
	"name"=> "Tamiahua"
], [
	"inegi_id"=> 30152,
	"id"=> 152,
	"state_id"=> "Veracruz",
	"name"=> "Tampico Alto"
], [
	"inegi_id"=> 30153,
	"id"=> 153,
	"state_id"=> "Veracruz",
	"name"=> "Tancoco"
], [
	"inegi_id"=> 30154,
	"id"=> 154,
	"state_id"=> "Veracruz",
	"name"=> "Tantima"
], [
	"inegi_id"=> 30155,
	"id"=> 155,
	"state_id"=> "Veracruz",
	"name"=> "Tantoyuca"
], [
	"inegi_id"=> 30156,
	"id"=> 156,
	"state_id"=> "Veracruz",
	"name"=> "Tatatila"
], [
	"inegi_id"=> 30157,
	"id"=> 157,
	"state_id"=> "Veracruz",
	"name"=> "Castillo de Teayo"
], [
	"inegi_id"=> 30158,
	"id"=> 158,
	"state_id"=> "Veracruz",
	"name"=> "Tecolutla"
], [
	"inegi_id"=> 30159,
	"id"=> 159,
	"state_id"=> "Veracruz",
	"name"=> "Tehuipango"
], [
	"inegi_id"=> 30160,
	"id"=> 160,
	"state_id"=> "Veracruz",
	"name"=> "Temapache"
], [
	"inegi_id"=> 30161,
	"id"=> 161,
	"state_id"=> "Veracruz",
	"name"=> "Tempoal"
], [
	"inegi_id"=> 30162,
	"id"=> 162,
	"state_id"=> "Veracruz",
	"name"=> "Tenampa"
], [
	"inegi_id"=> 30163,
	"id"=> 163,
	"state_id"=> "Veracruz",
	"name"=> "Tenochtitlán"
], [
	"inegi_id"=> 30164,
	"id"=> 164,
	"state_id"=> "Veracruz",
	"name"=> "Teocelo"
], [
	"inegi_id"=> 30165,
	"id"=> 165,
	"state_id"=> "Veracruz",
	"name"=> "Tepatlaxco"
], [
	"inegi_id"=> 30166,
	"id"=> 166,
	"state_id"=> "Veracruz",
	"name"=> "Tepetlán"
], [
	"inegi_id"=> 30167,
	"id"=> 167,
	"state_id"=> "Veracruz",
	"name"=> "Tepetzintla"
], [
	"inegi_id"=> 30168,
	"id"=> 168,
	"state_id"=> "Veracruz",
	"name"=> "Tequila"
], [
	"inegi_id"=> 30169,
	"id"=> 169,
	"state_id"=> "Veracruz",
	"name"=> "José Azueta"
], [
	"inegi_id"=> 30170,
	"id"=> 170,
	"state_id"=> "Veracruz",
	"name"=> "Texcatepec"
], [
	"inegi_id"=> 30171,
	"id"=> 171,
	"state_id"=> "Veracruz",
	"name"=> "Texhuacán"
], [
	"inegi_id"=> 30172,
	"id"=> 172,
	"state_id"=> "Veracruz",
	"name"=> "Texistepec"
], [
	"inegi_id"=> 30173,
	"id"=> 173,
	"state_id"=> "Veracruz",
	"name"=> "Tezonapa"
], [
	"inegi_id"=> 30174,
	"id"=> 174,
	"state_id"=> "Veracruz",
	"name"=> "Tierra Blanca"
], [
	"inegi_id"=> 30175,
	"id"=> 175,
	"state_id"=> "Veracruz",
	"name"=> "Tihuatlán"
], [
	"inegi_id"=> 30176,
	"id"=> 176,
	"state_id"=> "Veracruz",
	"name"=> "Tlacojalpan"
], [
	"inegi_id"=> 30177,
	"id"=> 177,
	"state_id"=> "Veracruz",
	"name"=> "Tlacolulan"
], [
	"inegi_id"=> 30178,
	"id"=> 178,
	"state_id"=> "Veracruz",
	"name"=> "Tlacotalpan"
], [
	"inegi_id"=> 30179,
	"id"=> 179,
	"state_id"=> "Veracruz",
	"name"=> "Tlacotepec de Mejía"
], [
	"inegi_id"=> 30180,
	"id"=> 180,
	"state_id"=> "Veracruz",
	"name"=> "Tlachichilco"
], [
	"inegi_id"=> 30181,
	"id"=> 181,
	"state_id"=> "Veracruz",
	"name"=> "Tlalixcoyan"
], [
	"inegi_id"=> 30182,
	"id"=> 182,
	"state_id"=> "Veracruz",
	"name"=> "Tlalnelhuayocan"
], [
	"inegi_id"=> 30183,
	"id"=> 183,
	"state_id"=> "Veracruz",
	"name"=> "Tlapacoyan"
], [
	"inegi_id"=> 30184,
	"id"=> 184,
	"state_id"=> "Veracruz",
	"name"=> "Tlaquilpa"
], [
	"inegi_id"=> 30185,
	"id"=> 185,
	"state_id"=> "Veracruz",
	"name"=> "Tlilapan"
], [
	"inegi_id"=> 30186,
	"id"=> 186,
	"state_id"=> "Veracruz",
	"name"=> "Tomatlán"
], [
	"inegi_id"=> 30187,
	"id"=> 187,
	"state_id"=> "Veracruz",
	"name"=> "Tonayán"
], [
	"inegi_id"=> 30188,
	"id"=> 188,
	"state_id"=> "Veracruz",
	"name"=> "Totutla"
], [
	"inegi_id"=> 30189,
	"id"=> 189,
	"state_id"=> "Veracruz",
	"name"=> "Túxpam"
], [
	"inegi_id"=> 30190,
	"id"=> 190,
	"state_id"=> "Veracruz",
	"name"=> "Tuxtilla"
], [
	"inegi_id"=> 30191,
	"id"=> 191,
	"state_id"=> "Veracruz",
	"name"=> "Ursulo Galván"
], [
	"inegi_id"=> 30192,
	"id"=> 192,
	"state_id"=> "Veracruz",
	"name"=> "Vega de Alatorre"
], [
	"inegi_id"=> 30193,
	"id"=> 193,
	"state_id"=> "Veracruz",
	"name"=> "Veracruz"
], [
	"inegi_id"=> 30194,
	"id"=> 194,
	"state_id"=> "Veracruz",
	"name"=> "Villa Aldama"
], [
	"inegi_id"=> 30195,
	"id"=> 195,
	"state_id"=> "Veracruz",
	"name"=> "Xoxocotla"
], [
	"inegi_id"=> 30196,
	"id"=> 196,
	"state_id"=> "Veracruz",
	"name"=> "Yanga"
], [
	"inegi_id"=> 30197,
	"id"=> 197,
	"state_id"=> "Veracruz",
	"name"=> "Yecuatla"
], [
	"inegi_id"=> 30198,
	"id"=> 198,
	"state_id"=> "Veracruz",
	"name"=> "Zacualpan"
], [
	"inegi_id"=> 30199,
	"id"=> 199,
	"state_id"=> "Veracruz",
	"name"=> "Zaragoza"
], [
	"inegi_id"=> 30200,
	"id"=> 200,
	"state_id"=> "Veracruz",
	"name"=> "Zentla"
], [
	"inegi_id"=> 30201,
	"id"=> 201,
	"state_id"=> "Veracruz",
	"name"=> "Zongolica"
], [
	"inegi_id"=> 30202,
	"id"=> 202,
	"state_id"=> "Veracruz",
	"name"=> "Zontecomatlán de López y Fuentes"
], [
	"inegi_id"=> 30203,
	"id"=> 203,
	"state_id"=> "Veracruz",
	"name"=> "Zozocolco de Hidalgo"
], [
	"inegi_id"=> 30204,
	"id"=> 204,
	"state_id"=> "Veracruz",
	"name"=> "Agua Dulce"
], [
	"inegi_id"=> 30205,
	"id"=> 205,
	"state_id"=> "Veracruz",
	"name"=> "El Higo"
], [
	"inegi_id"=> 30206,
	"id"=> 206,
	"state_id"=> "Veracruz",
	"name"=> "Nanchital de Lázaro Cárdenas del Río"
], [
	"inegi_id"=> 30207,
	"id"=> 207,
	"state_id"=> "Veracruz",
	"name"=> "Tres Valles"
], [
	"inegi_id"=> 30208,
	"id"=> 208,
	"state_id"=> "Veracruz",
	"name"=> "Carlos A. Carrillo"
], [
	"inegi_id"=> 30209,
	"id"=> 209,
	"state_id"=> "Veracruz",
	"name"=> "Tatahuicapan de Juárez"
], [
	"inegi_id"=> 30210,
	"id"=> 210,
	"state_id"=> "Veracruz",
	"name"=> "Uxpanapa"
], [
	"inegi_id"=> 30211,
	"id"=> 211,
	"state_id"=> "Veracruz",
	"name"=> "San Rafael"
], [
	"inegi_id"=> 30212,
	"id"=> 212,
	"state_id"=> "Veracruz",
	"name"=> "Santiago Sochiapan"
], [
	"inegi_id"=> 31001,
	"id"=> 1,
	"state_id"=> "Yucatán",
	"name"=> "Abalá"
], [
	"inegi_id"=> 31002,
	"id"=> 2,
	"state_id"=> "Yucatán",
	"name"=> "Acanceh"
], [
	"inegi_id"=> 31003,
	"id"=> 3,
	"state_id"=> "Yucatán",
	"name"=> "Akil"
], [
	"inegi_id"=> 31004,
	"id"=> 4,
	"state_id"=> "Yucatán",
	"name"=> "Baca"
], [
	"inegi_id"=> 31005,
	"id"=> 5,
	"state_id"=> "Yucatán",
	"name"=> "Bokobá"
], [
	"inegi_id"=> 31006,
	"id"=> 6,
	"state_id"=> "Yucatán",
	"name"=> "Buctzotz"
], [
	"inegi_id"=> 31007,
	"id"=> 7,
	"state_id"=> "Yucatán",
	"name"=> "Cacalchén"
], [
	"inegi_id"=> 31008,
	"id"=> 8,
	"state_id"=> "Yucatán",
	"name"=> "Calotmul"
], [
	"inegi_id"=> 31009,
	"id"=> 9,
	"state_id"=> "Yucatán",
	"name"=> "Cansahcab"
], [
	"inegi_id"=> 31010,
	"id"=> 10,
	"state_id"=> "Yucatán",
	"name"=> "Cantamayec"
], [
	"inegi_id"=> 31011,
	"id"=> 11,
	"state_id"=> "Yucatán",
	"name"=> "Celestún"
], [
	"inegi_id"=> 31012,
	"id"=> 12,
	"state_id"=> "Yucatán",
	"name"=> "Cenotillo"
], [
	"inegi_id"=> 31013,
	"id"=> 13,
	"state_id"=> "Yucatán",
	"name"=> "Conkal"
], [
	"inegi_id"=> 31014,
	"id"=> 14,
	"state_id"=> "Yucatán",
	"name"=> "Cuncunul"
], [
	"inegi_id"=> 31015,
	"id"=> 15,
	"state_id"=> "Yucatán",
	"name"=> "Cuzamá"
], [
	"inegi_id"=> 31016,
	"id"=> 16,
	"state_id"=> "Yucatán",
	"name"=> "Chacsinkín"
], [
	"inegi_id"=> 31017,
	"id"=> 17,
	"state_id"=> "Yucatán",
	"name"=> "Chankom"
], [
	"inegi_id"=> 31018,
	"id"=> 18,
	"state_id"=> "Yucatán",
	"name"=> "Chapab"
], [
	"inegi_id"=> 31019,
	"id"=> 19,
	"state_id"=> "Yucatán",
	"name"=> "Chemax"
], [
	"inegi_id"=> 31020,
	"id"=> 20,
	"state_id"=> "Yucatán",
	"name"=> "Chicxulub Pueblo"
], [
	"inegi_id"=> 31021,
	"id"=> 21,
	"state_id"=> "Yucatán",
	"name"=> "Chichimilá"
], [
	"inegi_id"=> 31022,
	"id"=> 22,
	"state_id"=> "Yucatán",
	"name"=> "Chikindzonot"
], [
	"inegi_id"=> 31023,
	"id"=> 23,
	"state_id"=> "Yucatán",
	"name"=> "Chocholá"
], [
	"inegi_id"=> 31024,
	"id"=> 24,
	"state_id"=> "Yucatán",
	"name"=> "Chumayel"
], [
	"inegi_id"=> 31025,
	"id"=> 25,
	"state_id"=> "Yucatán",
	"name"=> "Dzán"
], [
	"inegi_id"=> 31026,
	"id"=> 26,
	"state_id"=> "Yucatán",
	"name"=> "Dzemul"
], [
	"inegi_id"=> 31027,
	"id"=> 27,
	"state_id"=> "Yucatán",
	"name"=> "Dzidzantún"
], [
	"inegi_id"=> 31028,
	"id"=> 28,
	"state_id"=> "Yucatán",
	"name"=> "Dzilam de Bravo"
], [
	"inegi_id"=> 31029,
	"id"=> 29,
	"state_id"=> "Yucatán",
	"name"=> "Dzilam González"
], [
	"inegi_id"=> 31030,
	"id"=> 30,
	"state_id"=> "Yucatán",
	"name"=> "Dzitás"
], [
	"inegi_id"=> 31031,
	"id"=> 31,
	"state_id"=> "Yucatán",
	"name"=> "Dzoncauich"
], [
	"inegi_id"=> 31032,
	"id"=> 32,
	"state_id"=> "Yucatán",
	"name"=> "Espita"
], [
	"inegi_id"=> 31033,
	"id"=> 33,
	"state_id"=> "Yucatán",
	"name"=> "Halachó"
], [
	"inegi_id"=> 31034,
	"id"=> 34,
	"state_id"=> "Yucatán",
	"name"=> "Hocabá"
], [
	"inegi_id"=> 31035,
	"id"=> 35,
	"state_id"=> "Yucatán",
	"name"=> "Hoctún"
], [
	"inegi_id"=> 31036,
	"id"=> 36,
	"state_id"=> "Yucatán",
	"name"=> "Homún"
], [
	"inegi_id"=> 31037,
	"id"=> 37,
	"state_id"=> "Yucatán",
	"name"=> "Huhí"
], [
	"inegi_id"=> 31038,
	"id"=> 38,
	"state_id"=> "Yucatán",
	"name"=> "Hunucmá"
], [
	"inegi_id"=> 31039,
	"id"=> 39,
	"state_id"=> "Yucatán",
	"name"=> "Ixil"
], [
	"inegi_id"=> 31040,
	"id"=> 40,
	"state_id"=> "Yucatán",
	"name"=> "Izamal"
], [
	"inegi_id"=> 31041,
	"id"=> 41,
	"state_id"=> "Yucatán",
	"name"=> "Kanasín"
], [
	"inegi_id"=> 31042,
	"id"=> 42,
	"state_id"=> "Yucatán",
	"name"=> "Kantunil"
], [
	"inegi_id"=> 31043,
	"id"=> 43,
	"state_id"=> "Yucatán",
	"name"=> "Kaua"
], [
	"inegi_id"=> 31044,
	"id"=> 44,
	"state_id"=> "Yucatán",
	"name"=> "Kinchil"
], [
	"inegi_id"=> 31045,
	"id"=> 45,
	"state_id"=> "Yucatán",
	"name"=> "Kopomá"
], [
	"inegi_id"=> 31046,
	"id"=> 46,
	"state_id"=> "Yucatán",
	"name"=> "Mama"
], [
	"inegi_id"=> 31047,
	"id"=> 47,
	"state_id"=> "Yucatán",
	"name"=> "Maní"
], [
	"inegi_id"=> 31048,
	"id"=> 48,
	"state_id"=> "Yucatán",
	"name"=> "Maxcanú"
], [
	"inegi_id"=> 31049,
	"id"=> 49,
	"state_id"=> "Yucatán",
	"name"=> "Mayapán"
], [
	"inegi_id"=> 31050,
	"id"=> 50,
	"state_id"=> "Yucatán",
	"name"=> "Mérida"
], [
	"inegi_id"=> 31051,
	"id"=> 51,
	"state_id"=> "Yucatán",
	"name"=> "Mocochá"
], [
	"inegi_id"=> 31052,
	"id"=> 52,
	"state_id"=> "Yucatán",
	"name"=> "Motul"
], [
	"inegi_id"=> 31053,
	"id"=> 53,
	"state_id"=> "Yucatán",
	"name"=> "Muna"
], [
	"inegi_id"=> 31054,
	"id"=> 54,
	"state_id"=> "Yucatán",
	"name"=> "Muxupip"
], [
	"inegi_id"=> 31055,
	"id"=> 55,
	"state_id"=> "Yucatán",
	"name"=> "Opichén"
], [
	"inegi_id"=> 31056,
	"id"=> 56,
	"state_id"=> "Yucatán",
	"name"=> "Oxkutzcab"
], [
	"inegi_id"=> 31057,
	"id"=> 57,
	"state_id"=> "Yucatán",
	"name"=> "Panabá"
], [
	"inegi_id"=> 31058,
	"id"=> 58,
	"state_id"=> "Yucatán",
	"name"=> "Peto"
], [
	"inegi_id"=> 31059,
	"id"=> 59,
	"state_id"=> "Yucatán",
	"name"=> "Progreso"
], [
	"inegi_id"=> 31060,
	"id"=> 60,
	"state_id"=> "Yucatán",
	"name"=> "Quintana Roo"
], [
	"inegi_id"=> 31061,
	"id"=> 61,
	"state_id"=> "Yucatán",
	"name"=> "Río Lagartos"
], [
	"inegi_id"=> 31062,
	"id"=> 62,
	"state_id"=> "Yucatán",
	"name"=> "Sacalum"
], [
	"inegi_id"=> 31063,
	"id"=> 63,
	"state_id"=> "Yucatán",
	"name"=> "Samahil"
], [
	"inegi_id"=> 31064,
	"id"=> 64,
	"state_id"=> "Yucatán",
	"name"=> "Sanahcat"
], [
	"inegi_id"=> 31065,
	"id"=> 65,
	"state_id"=> "Yucatán",
	"name"=> "San Felipe"
], [
	"inegi_id"=> 31066,
	"id"=> 66,
	"state_id"=> "Yucatán",
	"name"=> "Santa Elena"
], [
	"inegi_id"=> 31067,
	"id"=> 67,
	"state_id"=> "Yucatán",
	"name"=> "Seyé"
], [
	"inegi_id"=> 31068,
	"id"=> 68,
	"state_id"=> "Yucatán",
	"name"=> "Sinanché"
], [
	"inegi_id"=> 31069,
	"id"=> 69,
	"state_id"=> "Yucatán",
	"name"=> "Sotuta"
], [
	"inegi_id"=> 31070,
	"id"=> 70,
	"state_id"=> "Yucatán",
	"name"=> "Sucilá"
], [
	"inegi_id"=> 31071,
	"id"=> 71,
	"state_id"=> "Yucatán",
	"name"=> "Sudzal"
], [
	"inegi_id"=> 31072,
	"id"=> 72,
	"state_id"=> "Yucatán",
	"name"=> "Suma"
], [
	"inegi_id"=> 31073,
	"id"=> 73,
	"state_id"=> "Yucatán",
	"name"=> "Tahdziú"
], [
	"inegi_id"=> 31074,
	"id"=> 74,
	"state_id"=> "Yucatán",
	"name"=> "Tahmek"
], [
	"inegi_id"=> 31075,
	"id"=> 75,
	"state_id"=> "Yucatán",
	"name"=> "Teabo"
], [
	"inegi_id"=> 31076,
	"id"=> 76,
	"state_id"=> "Yucatán",
	"name"=> "Tecoh"
], [
	"inegi_id"=> 31077,
	"id"=> 77,
	"state_id"=> "Yucatán",
	"name"=> "Tekal de Venegas"
], [
	"inegi_id"=> 31078,
	"id"=> 78,
	"state_id"=> "Yucatán",
	"name"=> "Tekantó"
], [
	"inegi_id"=> 31079,
	"id"=> 79,
	"state_id"=> "Yucatán",
	"name"=> "Tekax"
], [
	"inegi_id"=> 31080,
	"id"=> 80,
	"state_id"=> "Yucatán",
	"name"=> "Tekit"
], [
	"inegi_id"=> 31081,
	"id"=> 81,
	"state_id"=> "Yucatán",
	"name"=> "Tekom"
], [
	"inegi_id"=> 31082,
	"id"=> 82,
	"state_id"=> "Yucatán",
	"name"=> "Telchac Pueblo"
], [
	"inegi_id"=> 31083,
	"id"=> 83,
	"state_id"=> "Yucatán",
	"name"=> "Telchac Puerto"
], [
	"inegi_id"=> 31084,
	"id"=> 84,
	"state_id"=> "Yucatán",
	"name"=> "Temax"
], [
	"inegi_id"=> 31085,
	"id"=> 85,
	"state_id"=> "Yucatán",
	"name"=> "Temozón"
], [
	"inegi_id"=> 31086,
	"id"=> 86,
	"state_id"=> "Yucatán",
	"name"=> "Tepakán"
], [
	"inegi_id"=> 31087,
	"id"=> 87,
	"state_id"=> "Yucatán",
	"name"=> "Tetiz"
], [
	"inegi_id"=> 31088,
	"id"=> 88,
	"state_id"=> "Yucatán",
	"name"=> "Teya"
], [
	"inegi_id"=> 31089,
	"id"=> 89,
	"state_id"=> "Yucatán",
	"name"=> "Ticul"
], [
	"inegi_id"=> 31090,
	"id"=> 90,
	"state_id"=> "Yucatán",
	"name"=> "Timucuy"
], [
	"inegi_id"=> 31091,
	"id"=> 91,
	"state_id"=> "Yucatán",
	"name"=> "Tinum"
], [
	"inegi_id"=> 31092,
	"id"=> 92,
	"state_id"=> "Yucatán",
	"name"=> "Tixcacalcupul"
], [
	"inegi_id"=> 31093,
	"id"=> 93,
	"state_id"=> "Yucatán",
	"name"=> "Tixkokob"
], [
	"inegi_id"=> 31094,
	"id"=> 94,
	"state_id"=> "Yucatán",
	"name"=> "Tixmehuac"
], [
	"inegi_id"=> 31095,
	"id"=> 95,
	"state_id"=> "Yucatán",
	"name"=> "Tixpéhual"
], [
	"inegi_id"=> 31096,
	"id"=> 96,
	"state_id"=> "Yucatán",
	"name"=> "Tizimín"
], [
	"inegi_id"=> 31097,
	"id"=> 97,
	"state_id"=> "Yucatán",
	"name"=> "Tunkás"
], [
	"inegi_id"=> 31098,
	"id"=> 98,
	"state_id"=> "Yucatán",
	"name"=> "Tzucacab"
], [
	"inegi_id"=> 31099,
	"id"=> 99,
	"state_id"=> "Yucatán",
	"name"=> "Uayma"
], [
	"inegi_id"=> 31100,
	"id"=> 100,
	"state_id"=> "Yucatán",
	"name"=> "Ucú"
], [
	"inegi_id"=> 31101,
	"id"=> 101,
	"state_id"=> "Yucatán",
	"name"=> "Umán"
], [
	"inegi_id"=> 31102,
	"id"=> 102,
	"state_id"=> "Yucatán",
	"name"=> "Valladolid"
], [
	"inegi_id"=> 31103,
	"id"=> 103,
	"state_id"=> "Yucatán",
	"name"=> "Xocchel"
], [
	"inegi_id"=> 31104,
	"id"=> 104,
	"state_id"=> "Yucatán",
	"name"=> "Yaxcabá"
], [
	"inegi_id"=> 31105,
	"id"=> 105,
	"state_id"=> "Yucatán",
	"name"=> "Yaxkukul"
], [
	"inegi_id"=> 31106,
	"id"=> 106,
	"state_id"=> "Yucatán",
	"name"=> "Yobaín"
], [
	"inegi_id"=> 32001,
	"id"=> 1,
	"state_id"=> "Zacatecas",
	"name"=> "Apozol"
], [
	"inegi_id"=> 32002,
	"id"=> 2,
	"state_id"=> "Zacatecas",
	"name"=> "Apulco"
], [
	"inegi_id"=> 32003,
	"id"=> 3,
	"state_id"=> "Zacatecas",
	"name"=> "Atolinga"
], [
	"inegi_id"=> 32004,
	"id"=> 4,
	"state_id"=> "Zacatecas",
	"name"=> "Benito Juárez"
], [
	"inegi_id"=> 32005,
	"id"=> 5,
	"state_id"=> "Zacatecas",
	"name"=> "Calera"
], [
	"inegi_id"=> 32006,
	"id"=> 6,
	"state_id"=> "Zacatecas",
	"name"=> "Cañitas de Felipe Pescador"
], [
	"inegi_id"=> 32007,
	"id"=> 7,
	"state_id"=> "Zacatecas",
	"name"=> "Concepción del Oro"
], [
	"inegi_id"=> 32008,
	"id"=> 8,
	"state_id"=> "Zacatecas",
	"name"=> "Cuauhtémoc"
], [
	"inegi_id"=> 32009,
	"id"=> 9,
	"state_id"=> "Zacatecas",
	"name"=> "Chalchihuites"
], [
	"inegi_id"=> 32010,
	"id"=> 10,
	"state_id"=> "Zacatecas",
	"name"=> "Fresnillo"
], [
	"inegi_id"=> 32011,
	"id"=> 11,
	"state_id"=> "Zacatecas",
	"name"=> "Trinidad García de la Cadena"
], [
	"inegi_id"=> 32012,
	"id"=> 12,
	"state_id"=> "Zacatecas",
	"name"=> "Genaro Codina"
], [
	"inegi_id"=> 32013,
	"id"=> 13,
	"state_id"=> "Zacatecas",
	"name"=> "General Enrique Estrada"
], [
	"inegi_id"=> 32014,
	"id"=> 14,
	"state_id"=> "Zacatecas",
	"name"=> "General Francisco R. Murguía"
], [
	"inegi_id"=> 32015,
	"id"=> 15,
	"state_id"=> "Zacatecas",
	"name"=> "El Plateado de Joaquín Amaro"
], [
	"inegi_id"=> 32016,
	"id"=> 16,
	"state_id"=> "Zacatecas",
	"name"=> "General Pánfilo Natera"
], [
	"inegi_id"=> 32017,
	"id"=> 17,
	"state_id"=> "Zacatecas",
	"name"=> "Guadalupe"
], [
	"inegi_id"=> 32018,
	"id"=> 18,
	"state_id"=> "Zacatecas",
	"name"=> "Huanusco"
], [
	"inegi_id"=> 32019,
	"id"=> 19,
	"state_id"=> "Zacatecas",
	"name"=> "Jalpa"
], [
	"inegi_id"=> 32020,
	"id"=> 20,
	"state_id"=> "Zacatecas",
	"name"=> "Jerez"
], [
	"inegi_id"=> 32021,
	"id"=> 21,
	"state_id"=> "Zacatecas",
	"name"=> "Jiménez del Teul"
], [
	"inegi_id"=> 32022,
	"id"=> 22,
	"state_id"=> "Zacatecas",
	"name"=> "Juan Aldama"
], [
	"inegi_id"=> 32023,
	"id"=> 23,
	"state_id"=> "Zacatecas",
	"name"=> "Juchipila"
], [
	"inegi_id"=> 32024,
	"id"=> 24,
	"state_id"=> "Zacatecas",
	"name"=> "Loreto"
], [
	"inegi_id"=> 32025,
	"id"=> 25,
	"state_id"=> "Zacatecas",
	"name"=> "Luis Moya"
], [
	"inegi_id"=> 32026,
	"id"=> 26,
	"state_id"=> "Zacatecas",
	"name"=> "Mazapil"
], [
	"inegi_id"=> 32027,
	"id"=> 27,
	"state_id"=> "Zacatecas",
	"name"=> "Melchor Ocampo"
], [
	"inegi_id"=> 32028,
	"id"=> 28,
	"state_id"=> "Zacatecas",
	"name"=> "Mezquital del Oro"
], [
	"inegi_id"=> 32029,
	"id"=> 29,
	"state_id"=> "Zacatecas",
	"name"=> "Miguel Auza"
], [
	"inegi_id"=> 32030,
	"id"=> 30,
	"state_id"=> "Zacatecas",
	"name"=> "Momax"
], [
	"inegi_id"=> 32031,
	"id"=> 31,
	"state_id"=> "Zacatecas",
	"name"=> "Monte Escobedo"
], [
	"inegi_id"=> 32032,
	"id"=> 32,
	"state_id"=> "Zacatecas",
	"name"=> "Morelos"
], [
	"inegi_id"=> 32033,
	"id"=> 33,
	"state_id"=> "Zacatecas",
	"name"=> "Moyahua de Estrada"
], [
	"inegi_id"=> 32034,
	"id"=> 34,
	"state_id"=> "Zacatecas",
	"name"=> "Nochistlán de Mejía"
], [
	"inegi_id"=> 32035,
	"id"=> 35,
	"state_id"=> "Zacatecas",
	"name"=> "Noria de Ángeles"
], [
	"inegi_id"=> 32036,
	"id"=> 36,
	"state_id"=> "Zacatecas",
	"name"=> "Ojocaliente"
], [
	"inegi_id"=> 32037,
	"id"=> 37,
	"state_id"=> "Zacatecas",
	"name"=> "Pánuco"
], [
	"inegi_id"=> 32038,
	"id"=> 38,
	"state_id"=> "Zacatecas",
	"name"=> "Pinos"
], [
	"inegi_id"=> 32039,
	"id"=> 39,
	"state_id"=> "Zacatecas",
	"name"=> "Río Grande"
], [
	"inegi_id"=> 32040,
	"id"=> 40,
	"state_id"=> "Zacatecas",
	"name"=> "Sain Alto"
], [
	"inegi_id"=> 32041,
	"id"=> 41,
	"state_id"=> "Zacatecas",
	"name"=> "El Salvador"
], [
	"inegi_id"=> 32042,
	"id"=> 42,
	"state_id"=> "Zacatecas",
	"name"=> "Sombrerete"
], [
	"inegi_id"=> 32043,
	"id"=> 43,
	"state_id"=> "Zacatecas",
	"name"=> "Susticacán"
], [
	"inegi_id"=> 32044,
	"id"=> 44,
	"state_id"=> "Zacatecas",
	"name"=> "Tabasco"
], [
	"inegi_id"=> 32045,
	"id"=> 45,
	"state_id"=> "Zacatecas",
	"name"=> "Tepechitlán"
], [
	"inegi_id"=> 32046,
	"id"=> 46,
	"state_id"=> "Zacatecas",
	"name"=> "Tepetongo"
], [
	"inegi_id"=> 32047,
	"id"=> 47,
	"state_id"=> "Zacatecas",
	"name"=> "Teul de González Ortega"
], [
	"inegi_id"=> 32048,
	"id"=> 48,
	"state_id"=> "Zacatecas",
	"name"=> "Tlaltenango de Sánchez Román"
], [
	"inegi_id"=> 32049,
	"id"=> 49,
	"state_id"=> "Zacatecas",
	"name"=> "Valparaíso"
], [
	"inegi_id"=> 32050,
	"id"=> 50,
	"state_id"=> "Zacatecas",
	"name"=> "Vetagrande"
], [
	"inegi_id"=> 32051,
	"id"=> 51,
	"state_id"=> "Zacatecas",
	"name"=> "Villa de Cos"
], [
	"inegi_id"=> 32052,
	"id"=> 52,
	"state_id"=> "Zacatecas",
	"name"=> "Villa García"
], [
	"inegi_id"=> 32053,
	"id"=> 53,
	"state_id"=> "Zacatecas",
	"name"=> "Villa González Ortega"
], [
	"inegi_id"=> 32054,
	"id"=> 54,
	"state_id"=> "Zacatecas",
	"name"=> "Villa Hidalgo"
], [
	"inegi_id"=> 32055,
	"id"=> 55,
	"state_id"=> "Zacatecas",
	"name"=> "Villanueva"
], [
	"inegi_id"=> 32056,
	"id"=> 56,
	"state_id"=> "Zacatecas",
	"name"=> "Zacatecas"
], [
	"inegi_id"=> 32057,
	"id"=> 57,
	"state_id"=> "Zacatecas",
	"name"=> "Trancoso"
], [
	"inegi_id"=> 32058,
	"id"=> 58,
	"state_id"=> "Zacatecas",
	"name"=> "Santa María de la Paz"
]];

			      foreach ($cities as $key => $value) {
			      	// Guardar Provincias
			      	// DB::table('provincias')->insert(
				      //   [
				      //    'nombre' => $value['provincia'],
				      //    'codigo_postal' => $key,
				      //    'codigo_telefono' => $value['provincia'],
				      //    'status' =>'A'
			       //  ]);
			        // Guardar cantones
			      	// foreach ($value['cantones'] as $keyc => $canton) {
			      	// 	echo $canton['canton'];
			      		DB::table('ciudades')->insert(
					        [
					         'nombre' => $value['name'],
					         'codigo_postal' => '111112',
					         'provincia' => $value['state_id'],
					         'status' =>'A'
				        ]);
			      	// }
			      }

      return response()->json(["respuesta" => true]);           	
    }
}
