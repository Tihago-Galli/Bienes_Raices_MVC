/// <reference types="cypress" />
describe('Probando el homepage', () => {
    it('Probando el header', () => {
       
        cy.visit('/');

        cy.get("[data-cy='headign-sitio']").should('exist'); //revisa de que exista 
        cy.get("[data-cy='headign-sitio']").invoke('text').should('equal', 'Venta de Casas y Departamentos Exclusivos de Lujo'); //revisa que esa etiqueta tenga ese titulo
    });

    it('Probando el bloque de los iconos', () => {
       
        cy.get("[data-cy='heading-nosotros']").should('exist'); 
        cy.get("[data-cy='heading-nosotros']").should('have.prop', 'tagName').should('equal', 'H2'); //revisa que exista la etiqueta con ese h2
    
        cy.get("[data-cy='iconos-nosotros']").should('exist'); 
        cy.get("[data-cy='iconos-nosotros']").find('.icono').should('have.length', 3); //comprueba de que hayan 3 bloques con esa clase
        cy.get("[data-cy='iconos-nosotros']").find('.icono').should('not.have.length', 4);//comprueba de que no hayan 4 bloques con esa clase
    
    });

    it('Probando el bloque de las propiedades', () => {
       
        cy.get("[data-cy='anuncio']").should('have.length', 3); 
        cy.get("[data-cy='anuncio']").should('not.have.length', 5); 

        
        cy.get("[data-cy='anuncio-boton']").should('have.class', 'boton-amarillo'); 
    
        cy.get("[data-cy='anuncio-boton']").first().invoke('text').should('equal', 'Ver Anuncio');
    
        //pr0bar enlace a una propiedad
        cy.get("[data-cy='anuncio-boton']").first().click();
        cy.get("[data-cy='titulo-propiedad']").should('exist');

        cy.wait(1000);
        cy.go('back');
     

    });

    it('probando el routing de las propiedades', ()=> {
        //prueda de que el enlace lleve a la vista correspondiente
        cy.get("[data-cy='boton-propiedades']").should('exist');
        cy.get("[data-cy='boton-propiedades']").invoke('attr', 'href').should('equal', '/propiedades'); 
        //probamos el enlace a esa pagina
        cy.get("[data-cy='boton-propiedades']").click();

        cy.wait(1000);
        cy.go('back');

    })

    it("probando el bloque de contacto", () =>{

        cy.get("[data-cy='imagen-contacto']").should('exist');
        //buscamos de que existan cada etiqueta dentro de este bloque
        cy.get("[data-cy='imagen-contacto']").find('h3').invoke('text').should('equal', 'Envianos un Mail y contactanos!');
        cy.get("[data-cy='imagen-contacto']").find('p').invoke('text').should('equal', 'Lorem ipsdebitis harum? Sequi corrupti aperiam nobis ducimus unde. Alias, architecto sit?');
        //attr es que vamos a seleccionar un atributo, le pasamos el atributo href
        cy.get("[data-cy='imagen-contacto']").find('a').invoke('attr', 'href')
        .then( href =>{
            cy.visit(href)
        })

        cy.wait(1000);
        cy.visit('/');

    });

    it('probando blog y testimoniales', () =>{
        cy.get("[data-cy='blog']").should('exist');
        cy.get("[data-cy='blog']").find('h3').invoke('text').should('equal', 'Nuestro Blog');
        
        cy.get("[data-cy='testimoniales']").should('exist');
        cy.get("[data-cy='testimoniales']").find('h3').invoke('text').should('equal', 'Testimoniales');


    })

});