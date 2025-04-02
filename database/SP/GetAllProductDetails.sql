DELIMITER $$

CREATE PROCEDURE GetAllProductDetails(IN productId INT)
BEGIN
    SELECT 
        p.Naam AS ProductNaam,
        p.Barcode,
        MAX(CASE WHEN a.Naam = 'Gluten' THEN 'Ja' ELSE 'Nee' END) AS BevatGluten,
        MAX(CASE WHEN a.Naam = 'Gelatine' THEN 'Ja' ELSE 'Nee' END) AS BevatGelatine,
        MAX(CASE WHEN a.Naam = 'AZO-Kleurstof' THEN 'Ja' ELSE 'Nee' END) AS BevatAZOKleurstof,
        MAX(CASE WHEN a.Naam = 'Lactose' THEN 'Ja' ELSE 'Nee' END) AS BevatLactose,
        MAX(CASE WHEN a.Naam = 'Soja' THEN 'Ja' ELSE 'Nee' END) AS BevatSoja
    FROM 
        product p
    LEFT JOIN 
        productperallergeen ppa ON p.Id = ppa.ProductId
    LEFT JOIN 
        allergeen a ON ppa.AllergeenId = a.Id
    WHERE 
        p.Id = productId
    GROUP BY 
        p.Id;
END$$

DELIMITER ;
