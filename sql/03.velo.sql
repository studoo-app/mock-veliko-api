DROP TABLE IF EXISTS velo;
create table velo
(
    velo_id      integer not null
        constraint velo_pk
            primary key autoincrement,
    type         TEXT,
    status       TEXT    not null,
    num_km_total integer,
    station_id_available integer not null
);
