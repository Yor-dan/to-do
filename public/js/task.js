export default class {
  constructor({ id, task, is_done, deadline }) {
    this.id = id;
    this.task = task;
    this.isDone = is_done;
    this.deadline = deadline;
  };

  async toggleDone() {
    this.isDone = this.isDone === 0 ? 1 : 0;
  };
};