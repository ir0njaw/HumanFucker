<?php 
include ("../bd.php");
mysqli_set_charset($link, "utf8");
// Создание шаблона (разархивирование)
$set_dir = $_POST['set_dir'];
$file = $_POST['file']; 
$title = mysqli_real_escape_string($link,$_POST['title']);


	$zip = new ZipArchive;
    $zip->open($file);
    $zip->extractTo($set_dir);
    $zip->close();


//Костыль, нужен для того, чтобы когда юзер введет креды, мы зафиксировали успешное действие и увеличили переменную count на 1 (в файле auth.php описано)
if($title == "Outlook"){
    $set_dir_to_reditect = 'https://'.$_SERVER['SERVER_NAME'].'/owa/';
	$set_dir_auth = $set_dir.'/owa/auth/auth.php';
    $set_dir_visited = $set_dir.'/owa/auth/visited.php';
    $description = "Сценарий. Новый почтовый сервер.
    Отправитель: Имя Фамилия, email.
    Даты проведения атак: с 03.11.2016.
    Цель: получение учетных данных сотрудников.  

                    Описание:
                    По списку email-адресов сотрудников производилась почтовая рассылка от имени информационного отдела. Ссылка в письме ведет на фишинговый ресурс, внешне имитирующий настоящий Outlook. В случае ввода учетных перехода на сайт и ввода учетных данных, нами логировались эти данные и использовались для дальнейшего развития атаки.
                    В ходе тестирования фиксировались три состояния: открытие письма, переход по ссылке, ввод учетных данных.";

}elseif($title == "Проверка пароля"){
    $set_dir_to_reditect = 'https://'.$_SERVER['SERVER_NAME'].'/check/';
	$set_dir_auth = $set_dir.'/check/auth.php';
    $set_dir_visited = $set_dir.'/check/visited.php';
    $description = "Сценарий. Проверка пароля 
                    Отправитель: Имя Фамилия, email 
                    Даты проведения атак: с 03.11.2016.
                    Цель: получение учетных данных сотрудников.

                    Описание:
                    По списку email-адресов сотрудников производилась почтовая рассылка от имени отдела безопасности. Ссылка в письме ведет на фишинговый ресурс, имитирующий сервис проверки пароля на соответствие корпоративной парольной политики. В случае  перехода на сайт и ввода учетных данных, эти данные логировались и использовались для дальнейшего развития атаки.
                    В ходе тестирования фиксировались три состояния: открытие письма, переход по ссылке, ввод учетных данных.";
}
elseif($title == "Вебинар"){
    $set_dir_to_reditect = 'https://'.$_SERVER['SERVER_NAME'].'/event/';
    $set_dir_visited = $set_dir.'/event/6f3249aa304055d6/visited.php';
    $description = "Сценарий. Проведение вебинара 
                    Отправитель: Имя Фамилия, email 
                    Даты проведения атак: с 03.11.2016.
                    Цель: компрометация машин сотрудников.

                    Описание:
                    По списку email-адресов сотрудников производилась почтовая рассылка от имени отдела безопасности. Ссылка в письме ведет на фишинговый ресурс, имитирующий популярную площадку для проведения вебинаров. На сайте находится описание того, что пользователю необходимо запустить плеер для загрузки вебинара. Под плеером замаскирован вредоносный hta-файл, который при запуске получает полный доступ на машине пользователя.
                    В ходе тестирования фиксировались три состояния: открытие письма, переход по ссылке, запуск вредоносного вложения.";
}
elseif($title == "Обновление VPN"){
    $set_dir_to_reditect = 'https://'.$_SERVER['SERVER_NAME'].'/openvpn/';
    $set_dir_visited = $set_dir.'/openvpn/visited.php';
    $description = "Сценарий. Обновление VPN 
                    Отправитель: Имя Фамилия, email 
                    Даты проведения атак: с 03.11.2016.
                    Цель: компрометация машин сотрудников.

                    Описание:
                    По списку email-адресов сотрудников производилась почтовая рассылка от имени информационного отдела. Ссылка в письме ведет на подконтрольный ресурс, с которого автоматически скачивается вредоносное вложение, имитирующее установочный файл vpn-клиента. В случае скачивания и запуска данного вложения машина становится подконтрольной.
                    В ходе тестирования фиксировались три состояния: открытие письма, переход по ссылке, запуск вредоносного вложения.";
}
elseif($title == "Перерасчет ЗП"){
    $set_dir_to_reditect = 'https://'.$_SERVER['SERVER_NAME'].'/pereraschet/';
    $set_dir_auth = $set_dir.'/pereraschet/listok.php';
    $set_dir_visited = $set_dir.'/pereraschet/files/listok.php';
    $description = "Сценарий. Перерасчет З/П
                    Отправитель: Михаил Зеленцов, m.zelencov@passwordgpu.ru 
                    Даты проведения атак: с 03.11.2016. 
                    Тематика писем: договор франчайзинга. 
                    Цель: компрометация машин сотрудников. 

                    Описание:
                    По списку email-адресов сотрудников производилась почтовая рассылка от имени отдела бухгалтерии. Файл, прикрепленный к письму, представлял из себя XLSM-документ с макро- сом. В случае запуска макроса на контролируемый сервер отправлялось имя текущего пользователя и его идентификатор.
                    Чтобы избежать просмотра документа в интерфейсе Почты, функциональность прикрепляемых файлов была имитирована в теле письма, технически вложения размещались на внешнем сервере и принудительно скачивались браузером.
                    В ходе тестирования фиксировались три состояния: открытие письма, сохранение вложения, запуск макроса.";
}
elseif($title == "Премия"){
    $set_dir_to_reditect = 'https://'.$_SERVER['SERVER_NAME'].'/premia/';
    $set_dir_auth = $set_dir.'/premia/listok.php';
    $set_dir_visited = $set_dir.'/premia/files/visited.php';
    $description = "Сценарий. Премия
                    тправитель: Михаил Зеленцов, m.zelencov@passwordgpu.ru 
                    Даты проведения атак: с 03.11.2016. 
                    Тематика писем: договор франчайзинга. 
                    Цель: компрометация машин сотрудников. 

                    Описание:
                    По списку email-адресов сотрудников производилась почтовая рассылка от имени отдела бухгалтерии. Файл, прикрепленный к письму, представлял из себя XLSM-документ с макро- сом. В случае запуска макроса на контролируемый сервер отправлялось имя текущего пользователя и его идентификатор.
                    Чтобы избежать просмотра документа в интерфейсе Почты, функциональность прикрепляемых файлов была имитирована в теле письма, технически вложения размещались на внешнем сервере и принудительно скачивались браузером.
                    В ходе тестирования фиксировались три состояния: открытие письма, сохранение вложения, запуск макроса.";
}
elseif($title == "Установка антивируса"){
    $set_dir_to_reditect = 'https://'.$_SERVER['SERVER_NAME'].'/avast/';
    $set_dir_visited = $set_dir.'/avast/visited.php';
    $description = "Сценарий. Обновление VPN 
                    Отправитель: Имя Фамилия, email 
                    Даты проведения атак: с 03.11.2016.
                    Цель: компрометация машин сотрудников.

                    Описание:
                    По списку email-адресов сотрудников производилась почтовая рассылка от имени отдела безопасности. Ссылка в письме ведет на подконтрольный ресурс, с которого автоматически скачивается вредоносное вложение, имитирующее установочный файл антивируса Avast. В случае скачивания и запуска данного вложения машина становится подконтрольной.
                    В ходе тестирования фиксировались три состояния: открытие письма, переход по ссылке, запуск вредоносного вложения.";
}

//Создание записи в базе о используемом векторе для статистики
       $query = mysqli_query($link,"INSERT INTO attacks_stats(attack_name, count,description) VALUES ('$title','0','$description')");
       $query1 = mysqli_query($link,"INSERT INTO deployed (attack_name, dir) VALUES ('$title','$set_dir') ");

//Заменяем слово #attack_name в файле auth.php на $title
    $file_contents_auth = file_get_contents($set_dir_auth);
    $file_contents_auth = str_replace('#attack_name',$title,$file_contents_auth);
    file_put_contents($set_dir_auth,$file_contents_auth);

    $file_contents_visited = file_get_contents($set_dir_visited);
    $file_contents_visited = str_replace('#attack_name',$title,$file_contents_visited);
    file_put_contents($set_dir_visited,$file_contents_visited);
    
    header("Location: $set_dir_to_reditect "); 
?>
