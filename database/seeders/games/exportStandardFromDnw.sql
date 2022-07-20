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
FROM (SELECT ma.gameID,
             turn,
             ma.unitType,
             ma.type,
             ma.viaConvoy,
             ma.country,
             t1.name as territory,
             t2.name as fromTerritory,
             t3.name as toTerritory
      FROM (SELECT ma.*,
                   g.variantID                AS mapID,
                   CASE
                       WHEN ma.countryID = 1 THEN 'ENGLAND'
                       WHEN ma.countryID = 2 THEN 'FRANCE'
                       WHEN ma.countryID = 3 THEN 'ITALY'
                       WHEN ma.countryID = 4 THEN 'GERMANY'
                       WHEN ma.countryID = 5 THEN 'AUSTRIA'
                       WHEN ma.countryID = 6 THEN 'TURKEY'
                       WHEN ma.countryID = 7 THEN 'RUSSIA'
                       ELSE 'not defined' END AS country
            FROM wD_MovesArchive ma
                     JOIN wD_Games g ON g.id = ma.gameID
            WHERE gameID = 27144
            ORDER BY turn DESC, countryID ASC) ma
               LEFT JOIN wD_Territories t1 ON ma.terrID = t1.id AND t1.mapID = ma.mapID
               LEFT JOIN wD_Territories t2 ON ma.fromTerrID = t2.id AND t2.mapID = ma.mapID
               LEFT JOIN wD_Territories t3 ON ma.toTerrID = t3.id AND t3.mapID = ma.mapID) base
ORDER BY turn_phase ASC, base.country ASC;