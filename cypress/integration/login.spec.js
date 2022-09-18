/// <reference types="cypress" />
describe('prueba la auntentificacion', () => {

    it('prueba del login', () => {

        cy.visit('/login');

        cy.get('[data-cy="formulario-login"]').should('exist');
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta"]').should('exist');
        cy.get('[data-cy="alerta"]').eq(0).should('have.class','error');
        cy.get('[data-cy="alerta"]').eq(1).should('have.class','error');
    
        
    })


        })