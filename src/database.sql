SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `embeds` (
  `id` int(32) NOT NULL,
  `userid` varchar(32) NOT NULL,
  `embed_title` varchar(128) NOT NULL,
  `embed_description` varchar(128) NOT NULL,
  `embed_color` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `invites` (
  `id` int(11) NOT NULL,
  `inviteCode` varchar(2048) NOT NULL,
  `inviteAuthor` varchar(64) NOT NULL DEFAULT 'System'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pastes` (
  `id` int(32) NOT NULL,
  `title` varchar(128) NOT NULL,
  `text` varchar(4096) NOT NULL,
  `language` varchar(32) NOT NULL,
  `views` int(32) NOT NULL DEFAULT 0,
  `author` varchar(64) NOT NULL,
  `random_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `toggles` (
  `maintenance` varchar(32) NOT NULL DEFAULT 'false',
  `allow_uploads` varchar(32) NOT NULL DEFAULT 'false',
  `announcement` varchar(2048) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `toggles` (`maintenance`, `allow_uploads`, `announcement`, `id`) VALUES
('false', 'true', 'Today is a beautyfull day ', 1);

CREATE TABLE `uploads` (
  `id` int(32) NOT NULL,
  `userid` int(32) NOT NULL,
  `username` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'Not Availible',
  `filename` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `hash_filename` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `original_filename` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'Not Defined',
  `filesize` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0.00 B',
  `delete_secret` varchar(16) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0000000000000000',
  `self_destruct_upload` varchar(32) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'false',
  `embed_color` varchar(7) CHARACTER SET utf8mb4 NOT NULL DEFAULT '#0303fc',
  `embed_author` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'M. Hills | File Host',
  `embed_title` varchar(1028) CHARACTER SET utf8mb4 DEFAULT '%filename (%filesize)',
  `embed_desc` varchar(1028) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'File Host',
  `role` varchar(32) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'User',
  `uploaded_at` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0000/00/00 00:00:00',
  `ip` varchar(32) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0.0.0.0',
  `views` int(32) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` varchar(128) NOT NULL DEFAULT '00000000-0000-0000-0000-000000000000',
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `banned` varchar(32) NOT NULL DEFAULT 'false',
  `invite` varchar(100) NOT NULL,
  `secret` varchar(128) NOT NULL,
  `embedcolor` varchar(128) NOT NULL DEFAULT '#0303fc',
  `embedauthor` varchar(128) DEFAULT '%username',
  `embedtitle` varchar(1028) NOT NULL DEFAULT '%filename (%filesize)',
  `embeddesc` varchar(1028) NOT NULL DEFAULT 'Uploaded at %date by %username',
  `role` varchar(32) NOT NULL DEFAULT 'User',
  `reg_date` varchar(64) NOT NULL DEFAULT '00/00/0000 00:00:00',
  `use_embed` varchar(32) NOT NULL DEFAULT 'true',
  `use_customdomain` varchar(32) NOT NULL DEFAULT 'false',
  `use_invisible_url` varchar(32) NOT NULL DEFAULT 'false',
  `use_emoji_url` varchar(32) NOT NULL DEFAULT 'false',
  `use_2fa` varchar(32) NOT NULL DEFAULT 'false',
  `self_destruct_upload` varchar(32) NOT NULL DEFAULT 'false',
  `filename_type` varchar(32) NOT NULL DEFAULT 'short',
  `url_type` varchar(32) NOT NULL DEFAULT 'short',
  `uploads` int(32) NOT NULL DEFAULT 0,
  `upload_domain` varchar(256) NOT NULL DEFAULT 'mhills.de',
  `discord_username` varchar(128) NOT NULL DEFAULT 'user#0000',
  `discord_id` varchar(64) NOT NULL DEFAULT '000000000000000000',
  `discord_nitro` varchar(32) NOT NULL DEFAULT 'No Nitro',
  `discord_avatar` varchar(256) NOT NULL DEFAULT 'https://preview.redd.it/nx4jf8ry1fy51.gif?format=png8&s=a5d51e9aa6b4776ca94ebe30c9bb7a5aaaa265a6',
  `inviter` varchar(64) NOT NULL DEFAULT 'System',
  `last_uploaded` varchar(128) NOT NULL DEFAULT 'Couldn''t find Date',
  `upload_limit` varchar(32) NOT NULL DEFAULT '500 MB',
  `upload_size_limit` varchar(32) NOT NULL DEFAULT '32 MB',
  `profile_description` varchar(256) NOT NULL DEFAULT 'No description set.',
  `profile_privacy` varchar(32) NOT NULL DEFAULT 'public',
  `upload_logo` varchar(512) NOT NULL,
  `upload_logo_toggle` varchar(32) NOT NULL DEFAULT 'false',


ALTER TABLE `embeds`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pastes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `toggles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`,`userid`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `embeds`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;

ALTER TABLE `invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8055;

ALTER TABLE `pastes`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

ALTER TABLE `toggles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `uploads`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1695;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;
