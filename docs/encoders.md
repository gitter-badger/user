#Encoders

An Encoder is required by `UserPassword` value object to create an encoded password from a given plain password. As many
strategies exist, an interface (`BenGor\User\Domain\Model\UserPasswordEncoder`) is available. Some adapters have been
already created for a plug and play usage. In case you have some specific requirement you can implement your own adapter.

##Existing encoders

* [SymfonySecurityBridge][1]

##Implement your own encoder

To implement your own encoder you need to implement `BenGorUser\User\Domain\Model\UserPasswordEncoder` interface methods
`encode()` and `isPasswordValid()`

[1]: https://github.com/BenGorUser/SymfonySecurityBridge
