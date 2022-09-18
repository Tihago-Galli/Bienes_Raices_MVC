/// <reference types="cypress" />
describe('prueba de navegacion y ruting', () => {

    it('prueba de formulario contacto', () => {
        cy.visit('/contacto');

        cy.get("[data-cy='input-nombre']").type('Tihago');
        cy.get("[data-cy='input-mensaje']").type('Quiero comprar casa');
        cy.get("[data-cy='input-opciones']").select('Compra'); //para probar un select
        cy.get("[data-cy='input-precio']").type('1231231');
        cy.get("[data-cy='input-contacto']").eq(0).check();//para probar un radio button
        cy.get("[data-cy='input-fecha']").type('2022-06-23'); //para probar la fecha
        cy.get("[data-cy='input-hora']").type('15:30');//para probar la hora

        cy.get('[data-cy="formulario-contacto"]').submit(); //para enviar el formulario

        cy.get('[data-cy="alerta"]').should('have.class', 'alerta').and('have.class', 'exito');//para añadir mas de una clase


    });
})