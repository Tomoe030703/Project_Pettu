<?php
$routes['default_controller'] = 'authcontroller';
// Đường dẫn ảo -> đường dẫn thật
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';

// Định tuyến API
$routes['api/login'] = 'auth/login'; // API login

// Admin API
$routes['api/pets/detailInfo'] = 'admin/home/getPetDetailInfo'; // API thông tin chi tiết của Pets
$routes['api/services/detailInfo'] = 'admin/service/getServiceDetailInfo'; // API thông tin chi tiết của Services
$routes['api/expert_team/detailInfo'] = 'admin/expertteam/getExpertTeamInfo'; // API lấy thông tin đội ngũ chuyên gia
$routes['api/blogs/listBlog'] = 'admin/blog/getListBlog'; // API lấy danh sách blog theo danh mục

?>