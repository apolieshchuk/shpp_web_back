# create new column in table
ALTER TABLE Books ADD isDeleted TINYINT(1) DEFAULT 0;

# create TTL
ALTER TABLE Books ADD deletedTTL TIMESTAMP NOT NULL DEFAULT 0;