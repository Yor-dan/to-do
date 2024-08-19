export default class {
  constructor(id, task, isDone, deadline) {
    this.id = id;
    this.task = task;
    this.isDone = isDone;
    this.deadline = deadline;
  };

  toggleDone() {
    this.isDone = this.isDone === '0' ? '1' : '0';
  };

  updateTask(task) {
    this.task = task;
  };
};