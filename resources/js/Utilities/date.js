import {format, parseISO} from 'date-fns';

const formatDate = (date) => format(parseISO(date), 'dd/MM/yyyy  h:mm a');

export{
    formatDate,
}
