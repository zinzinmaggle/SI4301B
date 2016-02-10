$( document ).ready(function() {
    $('#select').change(function () {
        var value = $(this).val();

        var stringArray = new Array();
        var myRegex = /(^.*?)\|(.*?)\((.*?)\).*?\|(.*?)$/i;

        /*var string = value;
        string = string.split("|");



        for (var i = 0; i < string.length; i++) {
            stringArray.push(string[i].slice(0, -1));
            if (i == 1) {
                var tab = new Array();

                tmp = string[1];
                tab = tmp.split('(');

                stringArray.pop();
                stringArray.push(tab[0].slice(1, -1));
                stringArray.push(tab[1].slice(0, -1));


            }
        }*/
        $("#inputDescription").val(value.match(/(^.*?)\|(.*?)\|(.*?)\|(.*?)\((.*?)\).*?\|(.*?)$/)[1] +' | ' + value.match(/(^.*?)\|(.*?)\|(.*?)\|(.*?)\((.*?)\).*?\|(.*?)$/)[4]);
        $("#inputState").val(value.match(/(^.*?)\|(.*?)\((.*?)\).*?\|(.*?)$/)[3]);
        $("#inputPrice").val(value.match(/(^.*?)\|(.*?)\((.*?)\).*?\|(.*?)$/)[4]);
    });
});