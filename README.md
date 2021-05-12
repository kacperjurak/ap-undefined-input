# Error reproduction

This GraphQl query works

```graphql
mutation {
  createCompany(
    input: {company: {name: "test"}, companyMainContactPerson: {email: "test@test"}}
  ) {
    company {
      id
    }
    clientMutationId
  }
}
```

This GraphQl query doesn't work

```graphql
mutation {
  createCompany(
    input: {company: {name: "test"}, companyMainContactPerson: {email: "test@test"}}
  ) {
    company {
      id
      mainContactPerson {
        id
      }
    }
    clientMutationId
  }
}
```

Above query works on AP 2.5 but stopped working on 2.6.
