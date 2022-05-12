/// <reference types="cypress" />

describe("webflix sign up page tests", () => {

    beforeEach(() => {
        cy.viewport("macbook-16")
        cy.visit("http://localhost/_graded_unit/register.php")
    })

    it("displays an error when empty sign up form is submitted", () => {

        cy.get("#submit").click()
        cy.get("input:invalid").should("have.length.greaterThan", 0)
        cy.get("[name=forename]").then((input) => {
            expect(input[0].validationMessage).to.eq("Please fill out this field.")
        })
    })

    it("shows the card details form", () => {

        cy.get("#card-details").should("have.css", "display", "none")
        cy.get("#card-details").should("not.have.css", "display", "block")
        cy.get("#premium").click()
        cy.get("#card-details").should("have.css", "display", "block")
        cy.get("#card-details").should("not.have.css", "display", "none")
    })

    it("hides the card details form", () => {

        cy.get("#premium").click()
        cy.get("#card-details").should("have.css", "display", "block")
        cy.get("#card-details").should("not.have.css", "display", "none")

        cy.get("#basic").click()
        cy.get("#card-details").should("have.css", "display", "none")
        cy.get("#card-details").should("not.have.css", "display", "block")
    })

    it("displays an error when password are not matching", () => {

        const forename = "Maciej";
        const surname = "Fec"
        const email = "email@email.com"
        const password = "P@ssword"
        const confirmPassword = "pAssword"

        cy.get("#error").should("not.exist")
        
        cy.get("[name=forename]").type(forename)
        cy.get("[name=surname]").type(surname)
        cy.get("[name=email]").type(email)
        cy.get("[name=password]").type(password)
        cy.get("[name=password2]").type(confirmPassword)
        cy.get("#submit").click()

        cy.get("#error").should("exist")
    })

    it("displays an error when email is aready registered", () => {

        const forename = "Maciej";
        const surname = "Fec"
        const email = "maciejfec1996@gmail.com"
        const password = "P@ssword"
        const confirmPassword = "P@ssword"

        cy.get("#error").should("not.exist")
        
        cy.get("[name=forename]").type(forename)
        cy.get("[name=surname]").type(surname)
        cy.get("[name=email]").type(email)
        cy.get("[name=password]").type(password)
        cy.get("[name=password2]").type(confirmPassword)
        cy.get("#submit").click()

        cy.get("#error").should("exist")
    })
})