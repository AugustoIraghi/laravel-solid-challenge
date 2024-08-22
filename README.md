1. How your project uses SOLID principles  
- Single Responsibility Principle (SRP)
_Micro Scale (Class Level):_
Services: Each service class (e.g., BalanceService, TransactionService, CurrencyConversionService) has a specific responsibility. For example, BalanceService handles balance-related logic, and CurrencyConversionService manages currency conversions. They do not perform validation, data access, or formatting.
Request Classes: Request classes like BalanceRequest and TransactionRequest are solely responsible for input validation and authorization checks, separating concerns from controllers and services.
_Macro Scale (System Architecture Level):_
Layered Architecture: The architecture is divided into layers such as Controllers (handling requests), Services (business logic), Repositories (data access), and Requests (input validation). Each layer has a distinct responsibility, ensuring that no layer does too much work or overlaps with another.
Middleware: Middleware classes, such as LastSeenMiddleware, handle cross-cutting concerns like logging the user's last activity, keeping the responsibilities of user-related operations separate.
- Open/Closed Principle (OCP)
_Micro Scale (Class Level):_
Currency Drivers: The currency converter feature uses drivers (XML, JSON, CSV), allowing the addition of new drivers without modifying the existing code. The CurrencyDriverFactory can instantiate new driver implementations without altering core logic.
Repositories and Services: Services and repositories are designed so that new features (e.g., new filters, calculations) can be added through new methods or extensions without changing the existing class definitions.
_Macro Scale (System Architecture Level):_
Extensible System: The system architecture supports extension through configuration and dependency injection. New services, drivers, or layers can be added without affecting the existing system, thanks to the decoupled nature of the components. For instance, adding a new payment gateway or notification system involves extending current components rather than modifying them.
- Liskov Substitution Principle (LSP)
_Micro Scale (Class Level):_
Currency Conversion Drivers: All driver classes (XMLDriver, JSONDriver, CSVDriver) implement a common interface or abstract class, ensuring they can be used interchangeably without affecting the correctness of the CurrencyConversionService.
Repositories: If repositories are used, they implement a common contract, allowing any repository to be substituted without breaking the dependent service logic.
_Macro Scale (System Architecture Level):_
Dependency Injection with Interfaces: Across the system, services and repositories implement interfaces or base classes that can be substituted freely. This allows for alternate implementations (e.g., mock services for testing) to be injected without altering high-level application logic.
- Interface Segregation Principle (ISP)
_Micro Scale (Class Level):_
Service Interfaces: Interfaces in the codebase are small and focused. For instance, BalanceServiceInterface deals only with balance-related methods, while CurrencyConversionInterface focuses on currency conversion. Each class implements only the methods it needs, avoiding the implementation of unnecessary functionality.
Repository Interfaces: If using repositories, their interfaces are segregated into smaller, more specific contracts, allowing each repository to focus on a particular data model or function (e.g., TransactionRepositoryInterface).
_Macro Scale (System Architecture Level):_
System Boundaries: The architecture avoids forcing classes to depend on large, monolithic interfaces. Instead, the system is composed of multiple smaller interfaces that represent different domains, ensuring that each component can be developed and evolved independently.
- Dependency Inversion Principle (DIP)

_Micro Scale (Class Level):_
Service Dependencies: Services and controllers depend on abstractions rather than concrete implementations. For example, the BalanceController depends on BalanceServiceInterface, and the CurrencyConversionService depends on CurrencyDriverInterface. This allows for flexibility in injecting different implementations, such as mocks for testing or different providers.
Event Broadcasting: Broadcasting notifications via events and listeners decouples different parts of the system. For example, when a transaction is added, it is logged and broadcasted without the TransactionService directly handling these operations.
_Macro Scale (System Architecture Level):_
Inversion of Control: The system architecture is based on the inversion of control (IoC) principle, managed via Laravel's service container. High-level modules (e.g., controllers, services) do not depend on low-level implementations but rather on interfaces. The actual implementations are bound in the service provider and injected automatically, ensuring that high-level logic remains decoupled from low-level details.
Loose Coupling with Third-Party APIs: The currency converter drivers abstract the details of accessing external exchange rate services. This abstraction is injected into services via a factory, ensuring that the business logic does not directly depend on external APIs.


2. What do you mean by proper use of PHPDoc? Provide examples in your code.

```php
// App\\Http\\Controllers\\TransactionController  
/**

*   Display the specified transaction.

*   @param \\App\\Models\\Transaction $transaction
*   @return \\Illuminate\\Http\\Response

*/  
public function show(Transaction $transaction)  
{  
    return new TransactionResource($transaction);  
}
```
3. What did you like or dislike about PHP 7+?

Likes

---

  
Error Handling Improvements  
Anonymous Classes  
Null Coalescing Operator (??)  
Spaceship Operator (\<=>)

---
Dislike(Not in PHP 7+)
Nullsafe Operator (?->)  
Union Types  
Match Expression(switch statement)

4. How do you feel about typing in PHP 7? When should you use it and when not? In your opinion...
   
Typing in PHP 7 is one of those features that, when used wisely, can make a significant positive impact on code quality. However, it’s not always necessary to enforce typing in every scenario. The decision to use it should be driven by the nature of the project, the complexity of the system, the need for robustness, and the speed of development.