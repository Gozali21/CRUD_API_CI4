CREATE TABLE `mahasiswa` (
  `id` char(36) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(64) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);
COMMIT;
