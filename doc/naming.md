# Naming conventions

| Endpoint | Service | Method | Message | Model |
| --- | --- | --- | --- | --- |
| `GET /cars` | `CarService` | `getCars()` | `Car/CarListMessage` | `Car/Car` |
| `POST /cars` | `CarService` | `postCar()` | `Car/CarPostMessage` | `Car/Car` |
| `POST /articles/publish` | `ArticleService` | `publishArticle()` | `Article/ArticlePublishMessage` | `Article/Article` |
| `GET /articles/{article}/categories` | `ArticleService` | `getCategories()` | `Article/CategoryListMessage` | `Article/Category` |
