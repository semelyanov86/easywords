export function dateFormatter(value:string):string {
    let date = new Date(value)
    return date.toLocaleString();
}
