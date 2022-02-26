/* eslint-disable prettier/prettier */
import { AmqpConnection, RabbitRPC } from '@golevelup/nestjs-rabbitmq';
import { Injectable } from '@nestjs/common';
import axios from 'axios';

@Injectable()
export class ConsumeEmailService {

    constructor(private readonly amqpConnection: AmqpConnection) {}

    @RabbitRPC({
        exchange: 'amq.direct',
        routingKey: 'publish-email',
        queue: 'publish-email-queue',
    })

      public async consumeEmail(email) {
        const meme = await axios.get('https://meme-api.herokuapp.com/gimme');
        email.meme = meme.data;
        this.SendEmail(email);
        console.log('email generated for user ' + email.email);
      }

    @RabbitRPC({
        exchange: 'amq.direct',
        routingKey: 'send-email',
        queue: 'send-email-queue',
    })

      public async SendEmail(data) {
        this.amqpConnection.publish('amq.direct', 'send-email', data);
      }
}
