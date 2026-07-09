# Focus Project — Current Implementation Status

## Stack
- Laravel 13 + PostgreSQL
- Laravel Fortify (Blade auth)
- Alpine.js frontend
- Service Layer + Action Classes

## What's Already Done ✅

### Infrastructure
- ✅ Fortify auth (login/register/logout) + home route
- ✅ web routes (tasks, projects, teams, comments, search)

### Migrations & Models
- ✅ users, teams, team_members, projects, project_members
- ✅ tasks, task_attachments, comments, activities
- ✅ All models with relationships

### Blade Views
- ✅ All views created (currently static — Step 17 pending)

### Controllers & Services
- ✅ DashboardController + DashboardService
- ✅ TaskController + TaskService + CreateTask + UpdateTask + CompleteTask + DeleteTask
- ✅ ProjectController + ProjectService + project/team management
- ✅ TeamController + TeamService
- ✅ CommentController (polymorphic)

### Policies & Middleware
- ✅ TaskPolicy
- ✅ ProjectPolicy (assumed from commit)
- ✅ TeamPolicy (assumed from commit)
- ✅ EnsureProjectMember middleware

### Events & Listeners
- ✅ Events + Listeners + Activity logging
- ✅ ActivityService

## What's Remaining ⏳

- ⏳ Step 10: AttachmentController (upload to storage/task-attachments)
- ⏳ Step 13: SearchController
- ⏳ Step 14: CalendarController (tasks grouped by due_date)
- ⏳ Step 15: ProfileController + avatar upload
- ⏳ Step 16: SettingsController
- ⏳ Step 17: Make ALL Blade views dynamic (replace static content with {{ }}, @foreach, etc.)

## Folder Structure
app/
├── Actions/Tasks/ ✅ (CreateTask, UpdateTask, CompleteTask, DeleteTask)
├── Actions/Projects/ ⏳
├── Actions/Teams/ ⏳
├── Events/ ⏳
├── Listeners/ ⏳
├── Http/Controllers/ (Dashboard✅, Task✅, others ⏳)
├── Http/Requests/ (Task✅, others ⏳)
├── Policies/ (Task✅, others ⏳)
└── Services/ (Dashboard✅, Task✅, others ⏳)

## Code Conventions
- Controllers are thin — only call Service methods
- Services contain all business logic
- Actions are single-responsibility __invoke classes
- Activity logging: ActivityService::log($user, $subject, 'action', $meta)
- All Blade views use compact() for data passing
- Auth: Laravel Fortify with Blade (NOT API, NOT JWT)

## Business Rules
- Tasks: subtasks max 1 level deep, completing all subtasks auto-completes parent
- Projects: progress auto-calculated from completed tasks %
- Teams: invite → status=invited, accept → status=active + joined_at=now()
- Roles: team(admin/member/guest), project(lead/member/viewer)
- Activity logged on: task.created, task.completed, priority_changed, comment.added, attachment.uploaded, project.member_added
