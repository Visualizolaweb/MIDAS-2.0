$(function() {
   //Login animation to center
    function toCenter(){
            var mainH=$("#main").outerHeight();
            var accountH=$(".account-wall").outerHeight();
            var marginT=(mainH-accountH)/2;
                   if(marginT>30){
                       $(".account-wall").css("margin-top",marginT-15);
                    }else{
                        $(".account-wall").css("margin-top",30);
                    }
        }
        toCenter();
        var toResize;
        $(window).resize(function(e) {
            clearTimeout(toResize);
            toResize = setTimeout(toCenter(), 500);
        });

    //Canvas Loading
      var throbber = new Throbber({  size: 32, padding: 17,  strokewidth: 2.8,  lines: 12, rotationspeed: 0, fps: 15 });
      throbber.appendTo(document.getElementById('canvas_loading'));
      throbber.start();

    $("#form-signin").submit(function(event){
            event.preventDefault();
            var main=$("#main");
            //scroll to top
            main.animate({
                scrollTop: 0
            }, 500);
            main.addClass("slideDown");

            // send username and password to php check login
            $.ajax({
                url: "../../controller/validousuario.controller.php", data: $(this).serialize(), type: "POST", dataType: 'json',
                success: function (e) {
                        setTimeout(function () { main.removeClass("slideDown") }, !e.status ? 500:3000);
                         if (!e.status) {
                             $.notific8(e.msn,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:"OPPS! OCURRIO UN ERROR :( "});
                            return false;
                         }
                         setTimeout(function () { $("#loading-top span").text("Bienvenido a MIDAS") }, 500);

                         if((e.profile == "PER-00002")&&(e.firstacc == 0)){
                           setTimeout(function () { $("#loading-top span").text("Espere un momento mientras cargamos la configuración inicial")  }, 1500);
                           setTimeout( "window.location.href='config_ini.php'", 3100 );
                         }else{
                           setTimeout(function () { $("#loading-top span").text("Cargando contenido de los laboratorios")  }, 1500);
                            setTimeout( "window.location.href='dashboard.php'", 3100 );
                         }
                }
            });

    });
});
