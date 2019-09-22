$(document).ready(function()
{
    user = $.cookie('user');
    if (user!=null)
    {
        $('#guestlabel').css('display','none');
        $('#namelabel').text(user);
        $('#namelabel').css('display','block');
        $('#exitbutton').css('display','block');
        $('#enterbutton').css('display','none');
        $('#regbutton').css('display','none');
        $('#plus').css('display','block');
        $('#minus').css('display','block');
        $('#moneyval').css('display','block');
    }
    $('.sendbutton').on('click',function(){
        
        data = $('#sendform').serialize();
        data = data +'&operation='+$(this).val();
        $.ajax({

            url: "operation.php",
            type: "POST",
            data: data,
            success: function(result)
            {
                new_money=(JSON.parse(result));
                for (i=0; i<new_money.length; i++)
                {
                    id = '#money'+i;
                    $(id).text(new_money[i]);
                    if (new_money[i]<50)
                    {
                        $(id).css('color','red');
                    } else{
                        $(id).css('color','black');
                    }
                }
            },
            errors: function()
            {
                alert('Ошибка');
            }

        })

    })

    $('.studentid').on('click',function(){

        id = $(this).attr('data-id');
        document.location.href="personal.php?id="+id;

    })
    
    $('#allcheck').on('change',function()
    {
        if ($(this).prop('checked'))
        {
            $('.studentcheckbox').prop('checked',true);
        } else
        {
            $('.studentcheckbox').prop('checked',false);
        }
    })

    $('#regbutton').on('click',function(){

        $('#regblock').css('display','block');

    })

    $('#enterbutton').on('click',function(){

        $('#enterblock').css('display','block');

    })

    $('#regbutton2').on('click', function(){
        pass1 = $('#pass').val();
        pass2 = $('#passrepeat').val();
        login = $('#login').val();
        if (login==''){
            alert('Поле логин не может быть пустым');
            return;
        }
        if (pass1==''){
            alert('Поле паролль не может быть пустым');
            return;
        }
        if (pass2==''){
            alert('Поле пароль ещё раз не может быть пустым');
            return;
        }
        if (pass1!=pass2)
        {
            alert('Пароли не совпадают');
            return;
        }
        data = $('#registrationform').serialize();
        $.ajax({

            url: "checkreg.php",
            method: "POST",
            data: data,
            success: function(result){
                alert(result);
                $('#regblock').css('display','none');
            },
            errors: function(){
                alert('Сбой регистрации');
            }

        })
    })

    $('#enterbutton2').on('click', function(){
        pass = $('#pass2').val();
        login = $('#login2').val();
        if (login==''){
            alert('Поле логин не может быть пустым');
            return;
        }
        if (pass ==''){
            alert('Поле паролль не может быть пустым');
            return;
        }
        data = $('#autorizationform').serialize();
        $.ajax({

            url: "autorization.php",
            method: "POST",
            data: data,
            success: function(result){
                if (result == "YES")
                {
                    alert('Вы успешно авторизировались как '+login);
                    date = new Date();
                    date.setMinutes(date.getMinutes()+10);
                    $.cookie('user',login,{expires: date});
                    $('#guestlabel').css('display','none');
                    $('#namelabel').text(login);
                    $('#namelabel').css('display','block');
                    $('#exitbutton').css('display','block');
                    $('#enterbutton').css('display','none');
                    $('#regbutton').css('display','none');
                    $('#plus').css('display','block');
                    $('#minus').css('display','block');
                    $('#moneyval').css('display','block');

                } else
                {
                    alert('Совпадений не найдено. Проверьте логин и пароль')
                }
                $('#enterblock').css('display','none');
            },
            errors: function(){
                alert('Сбой авторизации');
            }

        })
    })

    $('#closebutton').on('click',function(){
        $('.modal').css('display','none');
    })

    $('#closebutton2').on('click',function(){
        $('.modal').css('display','none');
    })

    $('#exitbutton').on('click',function(){
        $('#guestlabel').css('display','block');
        $('#namelabel').css('display','none');
        $('#exitbutton').css('display','none');
        $('#enterbutton').css('display','block');
        $('#regbutton').css('display','block');
        $('#plus').css('display','none');
        $('#minus').css('display','none');
        $('#moneyval').css('display','none');
        $.removeCookie('user');

    })

})