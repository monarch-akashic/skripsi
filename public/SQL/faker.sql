INSERT INTO users (id, role, name, email, password, phoneNo, dob, remember_token, created_at, updated_at) VALUES
(1, '1', 'VIRNANDO TAN WIJAYA', 'test@gmail.com', '$2y$10$lFLfUeerKffkr3AqBJ9a8ejnS0LgiWNjVgHotWsfaeygql1cNEpAG', '123123123123', '2022-07-06', NULL, '2022-07-02 16:36:02', '2022-07-02 19:02:29'),
(2, '2', 'PT. XYZ', 'company@gmail.com', '$2y$10$DZLGHj/jxHhDYZcuRf5Kiu8i24bC4pGD8L3nOABo7DR2rr7XDAnd2', NULL, NULL, '2koBqpNTdf2Pjcj1xeu51Fpa9BZPNyLLoGu4JGFhSNjj4ZGTkUiNR8kRcJ64', '2022-07-02 19:03:33', '2022-07-02 19:03:33'),
(6, '0', 'Admin', 'admin@admin.com', '$2y$10$akev.VlE0y5H9upShu8y7epf.E9yFjv.eTsZg7bLsTbC754gbyMXO', '123123123', '2022-06-09', NULL, '2022-06-07 15:23:19', '2022-06-07 15:23:19'),
(7, '1', 'Xi Nan Chen', 'nandovtw109@gmail.com', '0', '081296992905', '2000-12-19', 'SNYenQeP6KkcFMqEFl2v9hop3zi0niYT4vl0EB8EVCLY2bDoGDRDjy4eTH5l', '2022-07-02 22:30:50', '2022-07-02 22:31:31'),
(8, '2', 'PT. ASD', 'company2@gmail.com', '$2y$10$nUT4M.mGeFYDZ6Q7q9O5a.h6kEyP3rGnuUOnWTEByGYbeJfr5Za2W', NULL, NULL, 'JeoLGEKPXHVfYxcGNYqBKDlIRxYMyvE1XlKFRr0p0EwMfQgwYRf2yg3YAzRF', '2022-07-02 23:19:43', '2022-07-02 23:19:43');

INSERT INTO portofolios (id, user_id, profile_image, education, experience, skills, location, latitude, longitude, portofolio_file, cv_file, created_at, updated_at) VALUES
(3, 1, 'user_dummy.jpg', '[{\"institute\":\"SMA\",\"year_start_institute\":\"2018\",\"year_end_institute\":\"2019\",\"institute_desc\":\"SMK\"}]', '[{\"experience\":\"fulltime\",\"year_start_experience\":\"2020\",\"year_end_experience\":\"2021\",\"experience_desc\":\"Magang 1\"}]', '[\"Communication\"]', 'Jln 123123123', '-6.148357', '106.866136', 'no_file', 'no_file', '2022-07-02 19:02:16', '2022-07-06 00:07:34'),
(4, 7, 'user_dummy.jpg', '[{\"institute\":\"SD\",\"year_start_institute\":\"2018\",\"year_end_institute\":\"2019\",\"institute_desc\":\"SD 1\"}]', '[{\"experience\":\"fulltime\",\"year_start_experience\":\"2020\",\"year_end_experience\":\"2021\",\"experience_desc\":\"Full Time 1\"}]', '[\"Public Speaking\"]', 'Jln 123123123123123', '-6.169191', '106.818598', 'no_file', 'no_file', '2022-07-02 22:31:31', '2022-07-02 22:31:31');

INSERT INTO companies (id, user_id, tagline, description, verified, flag_block, industry_type, company_size, company_type, logo, background, website_link, created_at, updated_at) VALUES
(2, 2, '#Pasti_Maju', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 'Yes', NULL, 'Media and news', 'Small', NULL, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 'link.com', '2022-07-02 19:09:33', '2022-07-06 20:53:00'),
(3, 8, '#Pasti_Maju', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 'Yes', NULL, 'Telecommunication', 'Small', NULL, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 'testinglink.com', '2022-07-02 23:19:58', '2022-07-09 14:01:26');


INSERT INTO vacancies (id, company_id, job_name, job_description, requirement, age, salary, workflow, notes, status_open, working_hour, total_applicant, location, latitude, longitude, province, kota, kecamatan, kode_pos, tag, flag_block, created_at, updated_at) VALUES
(3, 2, 'Direct Sales Admin', 'Melakukan Penjualan Layanan Internet Dan Tv Kabel Berbayar Secara Door To Door/Mobile Selling/Canvasing Serta Melakukan Maintance Ke Customer', '<ol><li>Pria/Wanita Usia Maksimal 40 Tahun</li><li>Pendidikan Minimal SMA/SMK/MA</li><li>Memiliki Kendaraan Roda 2 (Motor)</li><li>Memiliki SIM &amp; HP Android</li><li>Menyukai Kerja Lapangan</li><li>Sertifikat Vaksin (Minimal Vaksin 1)</li></ol>', '18-25', '190000 day', 'Check', 'NULL', 'Open', '07:00 AM-05:00 PM', '10', 'Jl KH. Syahdan, Gg Keluarga No 39 RT 06 RW 012', '-6.157366', '106.883368', '11', '157', '1940', '14510', NULL, NULL, '2022-07-03 01:16:09', '2022-07-03 16:13:35'),
(4, 2, 'Administrasi', '-Pengumpulan, Pencatatan Serta Pelaporan Semua Jenis Laporan Data Yang Berkaitan Dengan Berjalannya Operasional Di Perusahaan\r\n-Pengaturan Jadwal Dan Agenda Kantor\r\n-Surat Menyurat(Internal & Eksternal)', '<ul><li>Pria/Wanita</li><li>SMA/SMK – S1(Semua Jurusan)</li><li>Bertanggung Jawab , Teliti Dan Sabar</li><li>Mampu Mengoperasikan Computer Dan Ms.Office ( Visio &amp; Outlook)</li><li>Bahasa Inggris Aktif</li><li>Fresh Graduate Welcome</li></ul>', '10-25', '35000000 hour', 'Check', 'NULL', 'Open', '07:00 AM-07:00 PM', '10', 'Jl KH. Syahdan, Gg Keluarga', '-6.215858', '106.784273', '11', '155', '1906', '12830', '#kantor', NULL, '2022-07-03 15:03:56', '2022-07-03 16:10:26'),
(5, 2, 'HR Sales Supervisor', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>', '18-25', '30000000 month', 'Check', 'NULL', 'Open', '07:00 AM-07:00 PM', '15', 'Jln ASD', '-6.145184', '106.875225', '5', '157', '1940', '14510', NULL, NULL, '2022-07-03 15:05:21', '2022-07-03 16:10:45'),
(6, 2, 'English Teacher Freelance', 'Freelance English Teacher', '<ul><li>Moslem (willing to wear hijab for girls)</li><li>Male / Female</li><li>Max. age 35 years old</li><li>Domicile Bekasi/Cibitung area.</li><li>Fluent in English oral and written.</li><li>An enthusiasm for teaching young children.</li></ul>', '10-25', '190000 day', 'Check', 'Rejected cause....', 'Open', '05:00 AM-07:00 PM', '1', 'Jln 123ASD', '-6.198344', '107.217951', '8', '157', '1940', '14510', NULL, NULL, '2022-07-03 15:06:52', '2022-07-04 21:36:48'),
(8, 2, 'Office Boy Admin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s,', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s,&nbsp;</p>', '10-18', '190000 month', 'Check', 'NULL', 'Admin', '07:00 AM-05:00 PM', '5', 'Jln Testing', '-6.191790', '106.610708', '9', '156', '1915', '10310', '#admin', NULL, '2022-07-03 15:09:31', '2022-07-03 15:09:31'),
(10, 3, 'Administrasi Office', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever&nbsp;</p>', '10-25', '190000 month', 'Check', 'NULL', 'Open', '03:15 AM-03:15 AM', '5', 'Jl KH. Syahdan, Gg Keluarga', '-6.180479', '106.854404', '11', '156', '1915', '10310', '#kantor #admin #administrasi', NULL, '2022-07-04 23:21:07', '2022-07-04 23:21:42'),
(13, 2, 'Administrasi Kantor', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever&nbsp;</p>', '10-25', '190000 month', 'Check', 'NULL', 'Admin', '08:15 AM-04:15 PM', '20', 'Jl KH. Syahdan, Gg Keluarga No 39 RT 06 RW 012', '-6.174443', '106.771022', '11', '153', '1925', '11550', '#kantor #admin #administrasi', NULL, '2022-07-05 23:24:35', '2022-07-05 23:24:35'),
(15, 2, 'Direct Sales Office', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever&nbsp;</p>', '18-25', NULL, 'Check', 'NULL', 'Admin', '08:45 PM-08:45 PM', '20', 'Jl KH. Syahdan, Gg Keluarga', '-6.159564', '106.888130', '11', '156', '1913', '10120', '#kantor', NULL, '2022-07-05 23:53:11', '2022-07-05 23:53:11');


INSERT INTO applyings (id, vacancy_id, company_id, applicant_id, "current_user", status, interview_schedule, interview_location, notes, created_at, updated_at) VALUES
(11, 5, 2, 1, 2, 'Interview schedule sent', '10:00 - 11:00', 'link.com', 'asdasd', '2022-07-09 07:40:17', '2022-07-09 16:51:52'),
(12, 3, 2, 1, 2, 'Decline', NULL, NULL, NULL, '2022-07-09 07:48:51', '2022-07-09 07:53:45'),
(13, 4, 2, 1, 2, 'Rejected', '10:00 - 11:00', 'link.com', 'ASD', '2022-07-09 07:40:37', '2022-07-09 07:59:05'),
(14, 6, 2, 1, 2, 'Accepted', '10:00 - 11:00', 'link.com', 'ASD', '2022-07-09 07:40:48', '2022-07-09 07:58:34');


INSERT INTO notifications (id, user_id, subject, content, created_at, updated_at) VALUES
(2, 1, 'Interview Scheduled', 'Your job apply for HR Sales Supervisor has been scheduled, please check your applied jobs', '2022-07-10 16:37:20', '2022-07-09 16:37:20'),
(3, 1, 'Interview Scheduled', 'Your job apply for HR Sales Supervisor has been scheduled, please check your applied jobs', '2022-07-09 16:51:52', '2022-07-09 16:51:52');


INSERT INTO reportings (id, vacancy_id, company_id, applicant_id, "current_user", status, subject, details, file, notes, created_at, updated_at) VALUES
(1, 5, 2, 1, 'Admin', 'Finish', 'The salary doesn’t fit with the aggrement', 'The salary doesn’t fit with the aggrement', '1657223429_1_5.pdf', 'On process', '2022-07-07 05:50:29', '2022-07-07 05:56:21'),
(2, 10, 3, 1, 'Admin', 'Check by Admin', 'The salary doesn’t fit with the aggrement', 'The salary doesn’t fit with the aggrement', '1657223811_1_10.pdf', '-', '2022-07-07 05:56:51', '2022-07-07 05:56:51'),
(4, 5, 2, 1, 'Admin', 'Finish', 'The salary doesn’t fit with the aggrement', 'The salary doesn’t fit with the aggrement', '1657223967_1_5.pdf', 'On process', '2022-07-07 05:59:27', '2022-07-07 06:00:48'),
(5, 10, 3, 1, 'Admin', 'Check by Admin', 'The salary doesn’t fit with the aggrement', 'The salary doesn’t fit with the aggrement', '1657223997_1_10.pdf', '-', '2022-07-07 05:59:57', '2022-07-07 05:59:57'),
(6, 6, 2, 1, 'Admin', 'Rejected', 'The salary doesn’t fit with the agreement', 'The salary doesn’t fit with the agreement', '1657453900_1_6.pdf', 'asd', '2022-07-10 04:51:40', '2022-07-10 05:00:59');


INSERT INTO verifyings (id, company_id, "current_user", status, npwp, surat_izin_operational, surat_izin_distribusi, notes, bpom, created_at, updated_at) VALUES
(5, 2, 'Admin', 'Rejected', 'ASD', '1657191000_2.pdf', '1657191000_2.pdf', 'Data doesnt match the requirement', '1657191000_2.pdf', '2022-07-06 20:50:00', '2022-07-06 20:51:59'),
(6, 2, 'Admin', 'Verified', 'ASD', '1657191174_2.pdf', '1657191174_2.pdf', 'Verified', '1657191174_2.pdf', '2022-07-06 20:52:54', '2022-07-06 20:53:00'),
(7, 3, 'Admin', 'Verified', '123-123-123-123', '1657400462_3.pdf', '1657400462_3.pdf', 'Verified', '1657400462_3.pdf', '2022-07-09 14:01:02', '2022-07-09 14:01:26');
