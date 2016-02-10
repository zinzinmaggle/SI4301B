function Translate($var) {
    switch (language) {
        case "en":
            return $var;
        case "jp":
            var Translate_Object = new Object();
            Translate_Object['fr'] = new Object();
            Translate_Object['fr']['Click and drag in the plot area to zoom in'] = "ズームインは、プロットエリアでクリックしてドラッグ ";
            Translate_Object['fr']['Reset zoom'] = "ズームをリセット";
            Translate_Object['fr']["Seat occupancy"] = "座席使用";
            Translate_Object['fr'][" chair(s) on "] = " 脚/ ";
            Translate_Object['fr']["chair(s)"] = "脚";
            Translate_Object['fr']["Which represents"] = "つまり";
            Translate_Object['fr']["Variant chairs number"] = "椅子の可変脚数";
            Translate_Object['fr']["All selected"] = "全項目選択済み";
            Translate_Object['fr']["Select all"] = "全項目を選択";
            Translate_Object['fr']["# de % selected"] = "# ~ % 項目選択済み";
            Translate_Object['fr']["No matches found"] = "該当項目が見つかりません";
            if (typeof Translate_Object['fr'][$var] === "undefined") {
                return $var;
            }
            return Translate_Object['fr'][$var];
        case "fr":
            var Translate_Object = new Object();
            Translate_Object['fr'] = new Object();
            Translate_Object['fr']['Click and drag in the plot area to zoom in'] = "Cliquez et faites glisser dans la zone de tracé pour zoomer";
            Translate_Object['fr']['Reset zoom'] = "Réinitialiser zoom";
            Translate_Object['fr']["Seat occupancy"] = "Occupation de siège";
            Translate_Object['fr'][" chair(s) on "] = " siège(s) sur ";
            Translate_Object['fr']["chair(s)"] = "siège(s)";
            Translate_Object['fr']["Which represents"] = "Soit";
            Translate_Object['fr']["Variant chairs number"] = "Nombre de sièges variants";
            Translate_Object['fr']["All selected"] = "Tout selectionner";
            Translate_Object['fr']["Select all"] = "Tout selectionner";
            Translate_Object['fr']["# de % selected"] = "# de % sélectionné(s)";
            Translate_Object['fr']["No matches found"] = "Aucun résultat trouvé";
            Translate_Object['fr']["Humidity"] = "Humidité";
            Translate_Object['fr']["Temperature"] = "Température";
            Translate_Object['fr']["Noise"] = "Bruit";
            Translate_Object['fr']["Light"] = "Luminosité";
            Translate_Object['fr']["Air Quality"] = "Qualité de l'air";
            Translate_Object['fr']["Pressure"] = "Pression";
            Translate_Object['fr']["Comfort Zone"] = "Zone de confort";
            Translate_Object['fr']["Click and drag in the plot area to zoom in"] = "Cliquez et faites glisser dans la zone de traçage pour zoomer";
            Translate_Object['fr']["Pinch the chart to zoom in"] = "Pincez le graphique pour agrandir";
            if (typeof Translate_Object['fr'][$var] === "undefined") {
                return $var;
            }
            return Translate_Object['fr'][$var];
    }
}

