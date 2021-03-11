$(document).ready(function() {
    function getCookie(name) {
        var cookie = " " + document.cookie;
        var search = " " + name + "=";
        var setStr = null;
        var offset = 0;
        var end = 0;
        if (cookie.length > 0) {
            offset = cookie.indexOf(search);
            if (offset != -1) {
                offset += search.length;
                end = cookie.indexOf(";", offset)
                if (end == -1) {
                    end = cookie.length;
                }
                setStr = unescape(cookie.substring(offset, end));

            }
        }
        return (setStr);
        console.log(setStr);
    }
    user_id = getCookie("id");
    console.log(user_id);
    if (user_id !== null) {
        $(".logout").html('<form action="logout.php"> <input type="submit" name="submit" value="Выйти"></form>');
        $(".contacts").html('<p>Избранные контакты</p><div class="favorite"><table id="favorite"></table></div><p>Все контакты</p><div class="cont"><ul id="contacts_all"></ul></div>');
        $(".reguath").css('display', 'none');
    } else {
        console.log('test');
    }

    $("#auth").submit(function(login, password) {
        $.ajax({
            type: "POST",
            url: "login.php",
            data: $(this).serialize(),

            success: function(html) {



            }
        })
    });
    $.ajax({
        url: '/getcontacs.php',
        /* Куда пойдет запрос */
        method: 'get',
        /* Метод передачи (post или get) */
        dataType: 'html',
        /* Тип данных в ответе (xml, json, script, html). */
        data: { text: 'Контакты' },
        /* Параметры передаваемые в запросе. */
        success: function(data) { /* функция которая будет выполнена после успешного запроса.  */
            $('#contacts_all').html(data); /* В переменной data содержится ответ от index.php. */
            $(".add-to-favorite").click(function() {
                var link = $(this).attr("rel");
                if ($(this).text() == "Добавить в избранное") {
                    $(this).text("Удалить из избранного");
                    like(link, "0");

                } else {
                    $(this).text("Добавить в избранное");
                    like(link, "1");
                }
                //alert($(this).attr("rel"));           
            });
            //аякс который передает эти параметры в favorite.php
            function like(id, active, user_id) {
                console.log(id);
                console.log(active);
                user_id = getCookie("id");
                console.log(user_id);

                $.ajax({
                    type: "POST",
                    url: "favorite.php",
                    data: { like: id, active: active, user_id: user_id },

                    success: function(html) {
                        $.ajax({
                            type: "POST",
                            url: "getfavorite.php",
                            data: { user_id: user_id },

                            success: function(html) {
                                console.log(html);
                                $.ajax({
                                    url: '/getfavoritecontacts.php',
                                    method: 'POST',
                                    dataType: 'html',
                                    data: { contact_id: html },
                                    success: function(data) {
                                        console.log(data)
                                        $('#favorite').html(data);
                                    }
                                });


                            }
                        });
                        console.log(html);


                    }
                });

            }
        }
    });
    $.ajax({
        type: "POST",
        url: "getfavorite.php",
        data: { user_id: user_id },

        success: function(html) {


            console.log(html);
            $.ajax({
                url: '/getfavoritecontacts.php',
                method: 'POST',
                dataType: 'html',
                data: { contact_id: html },
                success: function(data) {
                    console.log(data)
                    $('#favorite').html(data);
                }
            });


        }
    });


});