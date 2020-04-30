### Необходимо реализовать функционал для имитации работы 4х лифтов в 10ти этажном здании.

#### Для проверки работоспособности должно быть:
- возможность увидеть расположение всех лифтов в системе;
- возможность увидеть активные заказы лифтов;
- возможность добавить заказ лифта на этаж.

#### Ограничения:
- при первом запуске лифты должны становиться в случайное положение, при последующем запуске положения должны сохраняться с прошлых тестов;
- при отсутствии заказов хотя бы один лифт должен находиться на первом этаже;
- должна быть информация какой из лифтов прибыл на заказ, и как он двигался;
- возможность просмотра логов всех (за всё время) вызовов (в формате: какой лифт на какой этаж сколько раз приехал);
- возможность просмотра логов (за все время) движения лифтов за итерацию (итерация - движения лифта до смены направления, например с 10->7->6->2);
- серверная логика должна быть написана на php 7;
- результат работы над задачей должен быть оформлен как для сдачи проекта, согласно личным стандартам Исполнителя.

#### Допущения:
- одновременно с системой может работать несколько человек;
- выбор дополнительных технологий не ограничен;
- все спорные вопросы в задаче может и должен решать Исполнитель;

#### Требования к реализации:
- состояние лифтов должно храниться в БД (желательно PostgreSQL);
- большая часть логики должна быть реализована на PHP, а не на JS.