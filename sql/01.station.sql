DROP TABLE IF EXISTS station;
create table station
(
    station_id  INT  not null
        constraint station_pk
            unique,
    stationCode INT  not null,
    name        TEXT not null,
    lat         TEXT,
    lon         TEXT,
    capacity    INT
);