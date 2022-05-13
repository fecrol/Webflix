/// <reference types="Cypress"/>

describe("webflix home page tests", () => {

    beforeEach(() => {
        const email = "maciejfec1996@gmail.com"
        const password = "password"

        cy.viewport("macbook-16")
        cy.visit("http://localhost/_graded_unit/login.php")
        cy.get("#email").type(email)
        cy.get("#password").type(password)
        cy.get("#submit").click()
    })

    it("checks user is on the home page", () => {
        cy.url().should("eq", "http://localhost/_graded_unit/home.php")
    })

    it("checks movies page loads", () => {
        cy.get("#movies").click()
        cy.url().should("eq", "http://localhost/_graded_unit/movies.php")
    })

    it("checks tv shows page loads", () => {
        cy.get("#tv-shows").click()
        cy.url().should("eq", "http://localhost/_graded_unit/tv-shows.php")
    })

    it("checks user account page loads", () => {
         cy.get("#navbarDropdown").click()
         cy.get("[class=dropdown-item]").click()
         cy.url().should("eq", "http://localhost/_graded_unit/user-account.php")
    })

    it("checks logout button works", () => {
        cy.get("#logout").click()
        cy.url().should("eq", "http://localhost/_graded_unit/login.php")
    })
})