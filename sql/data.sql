INSERT INTO `organizations` (`id`, `name`, `shortname`, `url`) VALUES
(1, 'Target Teal', 'targetteal', 'http://targetteal.com/');

INSERT INTO `roles` (`id`, `name`, `organization_id`, `parent_id`, `is_circle`, `purpose`, `accountabilities`, `domains`) VALUES
(1, 'Target Teal', 1, NULL, 1, '', '', ''),
(2, 'GD2 Circle', 1, 1, 1, '', '', ''),
(3, 'GD2 Guardian', 1, 2, 0, '', '', ''),
(4, 'Steward', 1, 1, 0, '', '', ''),
(5, 'Content Producer', 1, 1, 0, '', '', ''),
(6, 'Marketing', 1, 1, 1, '', '', ''),
(7, 'Inbound Marketing', 1, 6, 0, '', '', ''),
(8, 'Campaigns Master', 1, 6, 0, '', '', '');

INSERT INTO `users` (`id`, `name`, `email`, `password`, `organization_id`) VALUES
(1, 'Davi Gabriel da Silva', 'davi@targetteal.com', '$2y$10$JV3C3ESKEWlCqQHSkoPVuOb14N/EGMq9aa4.h4MXDEXE.WwkajWCW', 1);