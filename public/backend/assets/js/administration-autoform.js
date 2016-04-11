$( document ).ready(function() {
    $('#select').change(function () {
        var value = $(this).val();

        $("#inputDescription").val(value.match(/(^.*?)\|(.*?)\((.*?)\)/)[1] +" | "+ value.match(/(^.*?)\|(.*?)\((.*?)\)/)[2]);
        $("#inputState").val(value.match(/(^.*?)\|(.*?)\((.*?)\).*?\|(.*?)\|(.*?)$/)[3]);
        $("#inputPrice").val(value.match(/(^.*?)\|(.*?)\((.*?)\).*?\|(.*?)\|(.*?)$/)[4]);
        $("#inputImageUrl").val(value.match(/(^.*?)\|(.*?)\((.*?)\).*?\|(.*?)\|(.*?)$/)[5]);

        //(^.*?)\|(.*?)\((.*?)\).*?\|(.*?)\|(.*?)

    });
    $('#selectLotterie').change(function () {
        var value = $(this).val();

        $("#inputLotterie").val(value.match(/(^.*?)\#(.*?) /)[2]);

    });

    $('#generate-random-id').click(function () {
        var random = Math.round(Math.random()*100000) + 1;
        $("#inputID").val(random);

    });



});