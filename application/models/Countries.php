<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CountriesModel
{

    public static function GetAll()
    {
        $translate = Yaf\Registry::get("translate");
        $countries = array();
        $countries["US"] = $translate->_("United States");
        $countries["CA"] = $translate->_("Canada");
        $countries["UK"] = $translate->_("United Kingdom");
        $countries["AU"] = $translate->_("Australia");
        $countries["FR"] = $translate->_("France");
//        $countries["AF"] = $translate->_("Afghanistan");
//        $countries["AL"] = $translate->_("Albania");
//        $countries["DZ"] = $translate->_("Algeria");
//        $countries["AS"] = $translate->_("American Samoa");
//        $countries["AD"] = $translate->_("Andorra");
//        $countries["AO"] = $translate->_("Angola");
//        $countries["AI"] = $translate->_("Anguilla");
//        $countries["AQ"] = $translate->_("Antarctica");
//        $countries["AG"] = $translate->_("Antigua and Barbuda");
//        $countries["AR"] = $translate->_("Argentina");
//        $countries["AM"] = $translate->_("Armenia");
//        $countries["AW"] = $translate->_("Aruba");
//        $countries["AT"] = $translate->_("Austria");
//        $countries["AZ"] = $translate->_("Azerbaijan");
        $countries["BS"] = $translate->_("Bahamas");
//        $countries["BH"] = $translate->_("Bahrain");
//        $countries["BD"] = $translate->_("Bangladesh");
//        $countries["BB"] = $translate->_("Barbados");
//        $countries["BY"] = $translate->_("Belarus");
//        $countries["BE"] = $translate->_("Belgium");
//        $countries["BZ"] = $translate->_("Belize");
//        $countries["BJ"] = $translate->_("Benin");
//        $countries["BM"] = $translate->_("Bermuda");
//        $countries["BT"] = $translate->_("Bhutan");
//        $countries["BO"] = $translate->_("Bolivia");
//        $countries["BA"] = $translate->_("Bosnia and Herzegovina");
//        $countries["BW"] = $translate->_("Botswana");
//        $countries["BR"] = $translate->_("Brazil");
//        $countries["BN"] = $translate->_("Brunei Darussalam");
//        $countries["BG"] = $translate->_("Bulgaria");
//        $countries["BF"] = $translate->_("Burkina Faso");
//        $countries["BI"] = $translate->_("Burundi");
//        $countries["KH"] = $translate->_("Cambodia");
//        $countries["CM"] = $translate->_("Cameroon");
//        $countries["CV"] = $translate->_("Cape Verde");
//        $countries["KY"] = $translate->_("Cayman Islands");
//        $countries["CF"] = $translate->_("Central African Republic");
//        $countries["TD"] = $translate->_("Chad");
//        $countries["CL"] = $translate->_("Chile");
//        $countries["CN"] = $translate->_("China");
//        $countries["CX"] = $translate->_("Christmas Island");
//        $countries["CC"] = $translate->_("Cocos (Keeling) Islands");
//        $countries["CO"] = $translate->_("Colombia");
//        $countries["KM"] = $translate->_("Comoros");
//        $countries["CG"] = $translate->_("Congo");
//        $countries["CD"] = $translate->_("Congo, The Democratic Republic of the");
//        $countries["CK"] = $translate->_("Cook Islands");
//        $countries["CR"] = $translate->_("Costa Rica");
//        $countries["CI"] = $translate->_("Cote D`Ivoire");
//        $countries["HR"] = $translate->_("Croatia");
//        $countries["CY"] = $translate->_("Cyprus");
//        $countries["CZ"] = $translate->_("Czech Republic");
//        $countries["DK"] = $translate->_("Denmark");
//        $countries["DJ"] = $translate->_("Djibouti");
//        $countries["DM"] = $translate->_("Dominica");
//        $countries["DO"] = $translate->_("Dominican Republic");
//        $countries["EC"] = $translate->_("Ecuador");
//        $countries["EG"] = $translate->_("Egypt");
//        $countries["SV"] = $translate->_("El Salvador");
//        $countries["GQ"] = $translate->_("Equatorial Guinea");
//        $countries["ER"] = $translate->_("Eritrea");
//        $countries["EE"] = $translate->_("Estonia");
//        $countries["ET"] = $translate->_("Ethiopia");
//        $countries["FK"] = $translate->_("Falkland Islands (Malvinas)");
//        $countries["FO"] = $translate->_("Faroe Islands");
//        $countries["FJ"] = $translate->_("Fiji");
//        $countries["FI"] = $translate->_("Finland");
//        $countries["GF"] = $translate->_("French Guiana");
//        $countries["PF"] = $translate->_("French Polynesia");
//        $countries["GA"] = $translate->_("Gabon");
//        $countries["GM"] = $translate->_("Gambia");
//        $countries["GE"] = $translate->_("Georgia");
//        $countries["DE"] = $translate->_("Germany");
//        $countries["GH"] = $translate->_("Ghana");
//        $countries["GI"] = $translate->_("Gibraltar");
//        $countries["GR"] = $translate->_("Greece");
//        $countries["GL"] = $translate->_("Greenland");
//        $countries["GD"] = $translate->_("Grenada");
//        $countries["GP"] = $translate->_("Guadeloupe");
//        $countries["GU"] = $translate->_("Guam");
//        $countries["GT"] = $translate->_("Guatemala");
//        $countries["GN"] = $translate->_("Guinea");
//        $countries["GW"] = $translate->_("Guinea-Bissau");
//        $countries["GY"] = $translate->_("Guyana");
//        $countries["HT"] = $translate->_("Haiti");
//        $countries["HN"] = $translate->_("Honduras");
//        $countries["HK"] = $translate->_("Hong Kong");
//        $countries["HU"] = $translate->_("Hungary");
//        $countries["IS"] = $translate->_("Iceland");
//        $countries["IN"] = $translate->_("India");
//        $countries["ID"] = $translate->_("Indonesia");
//        $countries["IR"] = $translate->_("Iran (Islamic Republic Of)");
//        $countries["IQ"] = $translate->_("Iraq");
        $countries["IE"] = $translate->_("Ireland");
        $countries["IL"] = $translate->_("Israel");
//        $countries["IT"] = $translate->_("Italy");
//        $countries["JM"] = $translate->_("Jamaica");
//        $countries["JP"] = $translate->_("Japan");
//        $countries["JO"] = $translate->_("Jordan");
//        $countries["KZ"] = $translate->_("Kazakhstan");
//        $countries["KE"] = $translate->_("Kenya");
//        $countries["KI"] = $translate->_("Kiribati");
//        $countries["KP"] = $translate->_("Korea North");
//        $countries["KR"] = $translate->_("Korea South");
//        $countries["KW"] = $translate->_("Kuwait");
//        $countries["KG"] = $translate->_("Kyrgyzstan");
//        $countries["LA"] = $translate->_("Laos");
//        $countries["LV"] = $translate->_("Latvia");
//        $countries["LB"] = $translate->_("Lebanon");
//        $countries["LS"] = $translate->_("Lesotho");
//        $countries["LR"] = $translate->_("Liberia");
//        $countries["LI"] = $translate->_("Liechtenstein");
//        $countries["LT"] = $translate->_("Lithuania");
//        $countries["LU"] = $translate->_("Luxembourg");
//        $countries["MO"] = $translate->_("Macau");
//        $countries["MK"] = $translate->_("Macedonia");
//        $countries["MG"] = $translate->_("Madagascar");
//        $countries["MW"] = $translate->_("Malawi");
//        $countries["MY"] = $translate->_("Malaysia");
//        $countries["MV"] = $translate->_("Maldives");
//        $countries["ML"] = $translate->_("Mali");
//        $countries["MT"] = $translate->_("Malta");
//        $countries["MH"] = $translate->_("Marshall Islands");
//        $countries["MQ"] = $translate->_("Martinique");
//        $countries["MR"] = $translate->_("Mauritania");
//        $countries["MU"] = $translate->_("Mauritius");
        $countries["MX"] = $translate->_("Mexico");
//        $countries["FM"] = $translate->_("Micronesia");
//        $countries["MD"] = $translate->_("Moldova");
//        $countries["MC"] = $translate->_("Monaco");
//        $countries["MN"] = $translate->_("Mongolia");
//        $countries["MS"] = $translate->_("Montserrat");
//        $countries["MA"] = $translate->_("Morocco");
//        $countries["MZ"] = $translate->_("Mozambique");
//        $countries["NA"] = $translate->_("Namibia");
//        $countries["NP"] = $translate->_("Nepal");
//        $countries["NL"] = $translate->_("Netherlands");
//        $countries["AN"] = $translate->_("Netherlands Antilles");
//        $countries["NC"] = $translate->_("New Caledonia");
        $countries["NZ"] = $translate->_("New Zealand");
//        $countries["NI"] = $translate->_("Nicaragua");
//        $countries["NE"] = $translate->_("Niger");
//        $countries["NG"] = $translate->_("Nigeria");
//        $countries["NO"] = $translate->_("Norway");
//        $countries["OM"] = $translate->_("Oman");
//        $countries["PK"] = $translate->_("Pakistan");
//        $countries["PW"] = $translate->_("Palau");
//        $countries["PS"] = $translate->_("Palestine Autonomous");
//        $countries["PA"] = $translate->_("Panama");
//        $countries["PG"] = $translate->_("Papua New Guinea");
//        $countries["PY"] = $translate->_("Paraguay");
//        $countries["PE"] = $translate->_("Peru");
//        $countries["PH"] = $translate->_("Philippines");
//        $countries["PL"] = $translate->_("Poland");
//        $countries["PT"] = $translate->_("Portugal");
        $countries["PR"] = $translate->_("Puerto Rico");
//        $countries["QA"] = $translate->_("Qatar");
//        $countries["RE"] = $translate->_("Reunion");
//        $countries["RO"] = $translate->_("Romania");
//        $countries["RU"] = $translate->_("Russian Federation");
//        $countries["RW"] = $translate->_("Rwanda");
//        $countries["VC"] = $translate->_("Saint Vincent and the Grenadines");
//        $countries["MP"] = $translate->_("Saipan");
//        $countries["SM"] = $translate->_("San Marino");
//        $countries["SA"] = $translate->_("Saudi Arabia");
//        $countries["SN"] = $translate->_("Senegal");
//        $countries["SC"] = $translate->_("Seychelles");
//        $countries["SL"] = $translate->_("Sierra Leone");
//        $countries["SG"] = $translate->_("Singapore");
//        $countries["SK"] = $translate->_("Slovak Republic");
//        $countries["SI"] = $translate->_("Slovenia");
//        $countries["SO"] = $translate->_("Somalia");
        $countries["ZA"] = $translate->_("South Africa");
//        $countries["ES"] = $translate->_("Spain");
//        $countries["LK"] = $translate->_("Sri Lanka");
//        $countries["KN"] = $translate->_("St. Kitts/Nevis");
//        $countries["LC"] = $translate->_("St. Lucia");
//        $countries["SD"] = $translate->_("Sudan");
//        $countries["SR"] = $translate->_("Suriname");
//        $countries["SZ"] = $translate->_("Swaziland");
//        $countries["SE"] = $translate->_("Sweden");
//        $countries["CH"] = $translate->_("Switzerland");
//        $countries["SY"] = $translate->_("Syria");
//        $countries["TW"] = $translate->_("Taiwan");
//        $countries["TI"] = $translate->_("Tajikistan");
//        $countries["TZ"] = $translate->_("Tanzania");
//        $countries["TH"] = $translate->_("Thailand");
//        $countries["TG"] = $translate->_("Togo");
//        $countries["TK"] = $translate->_("Tokelau");
//        $countries["TO"] = $translate->_("Tonga");
//        $countries["TT"] = $translate->_("Trinidad and Tobago");
//        $countries["TN"] = $translate->_("Tunisia");
//        $countries["TR"] = $translate->_("Turkey");
//        $countries["TM"] = $translate->_("Turkmenistan");
//        $countries["TC"] = $translate->_("Turks and Caicos Islands");
//        $countries["TV"] = $translate->_("Tuvalu");
//        $countries["UG"] = $translate->_("Uganda");
//        $countries["UA"] = $translate->_("Ukraine");
//        $countries["AE"] = $translate->_("United Arab Emirates");
//        $countries["UY"] = $translate->_("Uruguay");
//        $countries["UZ"] = $translate->_("Uzbekistan");
//        $countries["VU"] = $translate->_("Vanuatu");
//        $countries["VE"] = $translate->_("Venezuela");
//        $countries["VN"] = $translate->_("Viet Nam");
//        $countries["VG"] = $translate->_("Virgin Islands (British)");
//        $countries["VI"] = $translate->_("Virgin Islands (U.S.)");
//        $countries["WF"] = $translate->_("Wallis and Futuna Islands");
//        $countries["YE"] = $translate->_("Yemen");
//        $countries["YU"] = $translate->_("Yugoslavia");
//        $countries["ZM"] = $translate->_("Zambia");
//        $countries["ZW"] = $translate->_("Zimbabwe");
        return $countries;
    }

    public static function getState($specifique = false)
    {
        $State = array();
        $State["US States"] = array();
        $State["Australian Provinces"] = array();
        $State["Canadian Provinces"] = array();

        $State["US States"]["AL"] = "Alabama";
        $State["US States"]["AK"] = "Alaska";
        $State["US States"]["AZ"] = "Arizona";
        $State["US States"]["AR"] = "Arkansas";
        $State["US States"]["BVI"] = "British Virgin Islands";
        $State["US States"]["CAN"] = "California Northern";
        $State["US States"]["CAS"] = "California Southern";

        $State["US States"]["CO"] = "Colorado";
        $State["US States"]["CT"] = "Connecticut";
        $State["US States"]["DE"] = "Delaware";
        $State["US States"]["FL"] = "Florida";
        $State["US States"]["GA"] = "Georgia";
        $State["US States"]["GU"] = "Guam";
        $State["US States"]["HI"] = "Hawaii";
        $State["US States"]["ID"] = "Idaho";
        $State["US States"]["IL"] = "Illinois";
        $State["US States"]["IN"] = "Indiana";
        $State["US States"]["IA"] = "Iowa";
        $State["US States"]["KS"] = "Kansas";
        $State["US States"]["KY"] = "Kentucky";
        $State["US States"]["LA"] = "Louisiana";
        $State["US States"]["ME"] = "Maine";
        $State["US States"]["MP"] = "Mariana Islands";
        $State["US States"]["MPI"] = "Mariana Islands (Pacific)";
        $State["US States"]["MD"] = "Maryland";
        $State["US States"]["MA"] = "Massachusetts";
        $State["US States"]["MI"] = "Michigan";
        $State["US States"]["MN"] = "Minnesota";
        $State["US States"]["MS"] = "Mississippi";
        $State["US States"]["MO"] = "Missouri";
        $State["US States"]["MT"] = "Montana";
        $State["US States"]["NE"] = "Nebraska";
        $State["US States"]["NV"] = "Nevada";
        $State["US States"]["NH"] = "New Hampshire";
        $State["US States"]["NJ"] = "New Jersey";
        $State["US States"]["NM"] = "New Mexico";
        $State["US States"]["NY"] = "New York";
        $State["US States"]["NC"] = "North Carolina";
        $State["US States"]["ND"] = "North Dakota";
        $State["US States"]["OH"] = "Ohio";
        $State["US States"]["OK"] = "Oklahoma";
        $State["US States"]["OR"] = "Oregon";
        $State["US States"]["PA"] = "Pennsylvania";
        $State["US States"]["PR"] = "Puerto Rico";
        $State["US States"]["RI"] = "Rhode Island";
        $State["US States"]["SC"] = "South Carolina";
        $State["US States"]["SD"] = "South Dakota";
        $State["US States"]["TN"] = "Tennessee";
        $State["US States"]["TX"] = "Texas";
        $State["US States"]["UT"] = "Utah";
        $State["US States"]["VT"] = "Vermont";
        $State["US States"]["USVI"] = "VI U.S. Virgin Islands";
        $State["US States"]["VA"] = "Virginia";
        $State["US States"]["WA"] = "Washington";
        $State["US States"]["DC"] = "Washington, D.C.";
        $State["US States"]["WV"] = "West Virginia";
        $State["US States"]["WI"] = "Wisconsin";
        $State["US States"]["WY"] = "Wyoming";


        $State["Australian Provinces"]["-AU-NSW"] = "New South Wales";
        $State["Australian Provinces"]["-AU-QLD"] = "Queensland";
        $State["Australian Provinces"]["-AU-SA"] = "South Australia";
        $State["Australian Provinces"]["-AU-TAS"] = "Tasmania";
        $State["Australian Provinces"]["-AU-VIC"] = "Victoria";
        $State["Australian Provinces"]["-AU-WA"] = "Western Australia";
        $State["Australian Provinces"]["-AU-ACT"] = "Australian Capital Territory";
        $State["Australian Provinces"]["-AU-NT"] = "Northern Territory";

        $State["Canadian Provinces"]["AB"] = "Alberta";
        $State["Canadian Provinces"]["BC"] = "British Columbia";
        $State["Canadian Provinces"]["MB"] = "Manitoba";
        $State["Canadian Provinces"]["NB"] = "New Brunswick";
        $State["Canadian Provinces"]["NF"] = "Newfoundland";
        $State["Canadian Provinces"]["NT"] = "Northwest Territories";
        $State["Canadian Provinces"]["NS"] = "Nova Scotia";
        $State["Canadian Provinces"]["NVT"] = "Nunavut";
        $State["Canadian Provinces"]["ON"] = "Ontario";
        $State["Canadian Provinces"]["PE"] = "Prince Edward Island";
        $State["Canadian Provinces"]["QC"] = "Quebec";
        $State["Canadian Provinces"]["SK"] = "Saskatchewan";
        $State["Canadian Provinces"]["YK"] = "Yukon";
        if ($specifique == "USA") {
            return $State["US States"];
        } else {
            return $State;
        }
    }

}