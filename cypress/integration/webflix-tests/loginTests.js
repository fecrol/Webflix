/// <reference types="cypress" />

describe("webflix login page tests", () => {
    beforeEach(() => {
        cy.viewport("macbook-16")
        cy.visit("http://localhost/_graded_unit/login.php")
    })

    it("displays error when empty login page is submitted", () => {

        cy.get("#submit").click()
        cy.get("input:invalid").should("have.length.greaterThan", 0)
        cy.get("#email").then((input) => {
            expect(input[0].validationMessage).to.eq("Please fill out this field.")
        })
    })

    it("displays error when login form is submitted with email only", () => {

        const email = "email@email.com"
        
        cy.get("#email").type(email)
        cy.get("#submit").click()
        cy.get("input:invalid").should("have.length.greaterThan", 0)
        cy.get("#password").then((input) => {
            expect(input[0].validationMessage).to.eq("Please fill out this field.")
        })
    })

    it("displays error when login form is submitted with password only", () => {

        const password = "password"
        
        cy.get("#password").type(password)
        cy.get("#submit").click()
        cy.get("input:invalid").should("have.length.greaterThan", 0)
        cy.get("#email").then((input) => {
            expect(input[0].validationMessage).to.eq("Please fill out this field.")
        })
    })

    it("displays error when invalid email is submitted", () => {

        const email = "emailemail.com"
        const password = "password"
        
        cy.get("#email").type(email)
        cy.get("#password").type(password)
        cy.get("#submit").click()
        cy.get("input:invalid").should("have.length.greaterThan", 0)
        cy.get("#email").then((input) => {
            expect(input[0].validationMessage).to.eq("Please include an '@' in the email address. '" + email + "' is missing an '@'.")
        })
    })

    it("displays error when user details are not registered", () => {

        const email = "fake@user.com"
        const password = "fakepassword"

        cy.get("#email").type(email)
        cy.get("#password").type(password)
        cy.get("#submit").click()

        cy.get("#error").should("exist")
    })

    it("logs user in when correct details are inputted", () => {

        const email = "maciejfec1996@gmail.com"
        const password = "password"

        cy.get("#email").type(email)
        cy.get("#password").type(password)
        cy.get("#submit").click()

        cy.url().should("eq", "http://localhost/_graded_unit/home.php")
    })

    it("loads the registration page", () => {

        cy.get("#reg-page-link").click()
        cy.url().should("eq", "http://localhost/_graded_unit/register.php")
    })
})