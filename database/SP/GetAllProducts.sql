DELIMITER $$

CREATE PROCEDURE GetAllProducts()
BEGIN
    SELECT 
        l.Naam AS LeverancierNaam,
        l.ContactPersoon,
        c.Stad,
        p.Naam AS ProductNaam,
        pel.EinddatumLevering,
        ppl.DatumLevering
    FROM 
        leverancier l
    LEFT JOIN 
        contact c ON l.ContactId = c.Id
    LEFT JOIN 
        product p ON l.Id = p.Id
    LEFT JOIN 
        ProductEinddatumLevering pel ON p.Id = pel.ProductId
    LEFT JOIN 
        productperleverancier ppl ON p.Id = ppl.ProductId
    ORDER BY 
        ppl.DatumLevering ASC;
END$$

DELIMITER ;