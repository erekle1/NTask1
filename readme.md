
## Implementation Overview

### Models

- **Campaign**: Represents a marketing campaign.
- **Step**: Represents a step within a campaign.
- **StepField**: Defines the fields required for a step.
- **Participation**: Stores user submissions, linked to specific campaigns.

### Factories

- Factories for `Campaign`, `Step`, `StepField`, and `Participation` models are created to facilitate easy and realistic database seeding.

### Controller Logic

- **storeParticipationData**: A method designed to update `Participation` records with new data, carefully checking to ensure that existing data is not overwritten.


### Repository 

- **ParticipationRepository**: Encapsulates all data access logic related to `Participation` entities. It provides a clear API for interacting with participations, such as creating or updating records without overwriting existing data.


### CampaignStepSubmissionRequest

- **CampaignStepSubmissionRequest**: A custom request class that dynamically generates validation rules based on the fields defined for each campaign step. It ensures that all required fields for a step are validated according to their specific rules, including custom validations such as age checks.
