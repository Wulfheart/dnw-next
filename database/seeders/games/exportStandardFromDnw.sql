SELECT *,
       CASE
           WHEN base.type IN ('hold', 'move', 'support hold', 'support move',
                              'convoy')
               THEN Concat(Lpad(base.turn, 5, 0), 'a')
           WHEN base.type IN ('retreat', 'disband') THEN
               Concat(Lpad(base.turn, 5, 0), 'b')
           WHEN base.type IN ('build army', 'build fleet', 'wait', 'destroy')
               THEN
               Concat(Lpad(base.turn, 5, 0), 'c')
           ELSE 'unsupported'
           end AS turn_phase
FROM (SELECT ma.gameid,
             turn,
             ma.unittype,
             Lower(ma.type) AS type,
             ma.viaconvoy,
             ma.country,
             t1.name        AS territory,
             t2.name        AS fromTerritory,
             t3.name        AS toTerritory
      FROM (SELECT ma.*,
                   g.variantid AS mapID,
                   CASE
                       WHEN ma.countryid = 1 THEN 'ENGLAND'
                       WHEN ma.countryid = 2 THEN 'FRANCE'
                       WHEN ma.countryid = 3 THEN 'ITALY'
                       WHEN ma.countryid = 4 THEN 'GERMANY'
                       WHEN ma.countryid = 5 THEN 'AUSTRIA'
                       WHEN ma.countryid = 6 THEN 'TURKEY'
                       WHEN ma.countryid = 7 THEN 'RUSSIA'
                       ELSE 'not defined'
                       end     AS country
            FROM wd_movesarchive ma
                     JOIN wd_games g
                          ON g.id = ma.gameid
            WHERE gameid = 27144
            ORDER BY turn DESC,
                     countryid ASC) ma
               LEFT JOIN wd_territories t1
                         ON ma.terrid = t1.id
                             AND t1.mapid = ma.mapid
               LEFT JOIN wd_territories t2
                         ON ma.fromterrid = t2.id
                             AND t2.mapid = ma.mapid
               LEFT JOIN wd_territories t3
                         ON ma.toterrid = t3.id
                             AND t3.mapid = ma.mapid) base
ORDER BY turn_phase;