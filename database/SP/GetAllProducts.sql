DELIMITER $$

CREATE PROCEDURE GetAllProducts()
BEGIN
    SELECT 
        p.Id AS ProductId,
        l.Naam AS LeverancierNaam,
        l.ContactPersoon,
        c.Stad,
        p.Naam AS ProductNaam,
        pel.EinddatumLevering,
        ppl.DatumLevering
    FROM 
        product p
    LEFT JOIN 
        productperleverancier ppl ON p.Id = ppl.ProductId
    LEFT JOIN 
        leverancier l ON ppl.LeverancierId = l.Id
    LEFT JOIN 
        contact c ON l.ContactId = c.Id
    LEFT JOIN 
        ProductEinddatumLevering pel ON p.Id = pel.ProductId
    ORDER BY 
        ppl.DatumLevering ASC;
END$$

DELIMITER ;